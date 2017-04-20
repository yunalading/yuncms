/**
 * Author : xfworld
 * Email : xf.key@163.com
 * Version : 1.1
 * Licensed under the MIT license:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	Project home:
 * 	https://github.com/xfworld/amazeuiUpload
 */


(function($) {
  'use strict';

  var AmazeuiUpload = function AmazeuiUpload(options) {
    this.url = options.url;
    this.downloadUrl = options.downloadUrl;
    this.maxFiles = options.maxFiles;
    this.maxFileSize = options.maxFileSize;
    this.multiThreading = options.multiThreading;
    this.fileType = options.fileType;
    this.useDefTemplate = options.useDefTemplate;
    this.knownType = options.knownType;
    this.selectMultiple = options.selectMultiple;
    this.selectType = options.selectType;
    this.dropType = options.dropType;
    this.pasteType = options.pasteType;
    this.context = options.context;
  }

  AmazeuiUpload.prototype._loadData = function() {
      if (this.maxFiles == null || this.maxFiles == undefined) {
        this.maxFiles = 2;
      }
      if (this.maxFileSize == null || this.maxFileSize == undefined) {
        this.maxFileSize = 2;
      }
      if (this.multiThreading == null || this.multiThreading == undefined) {
        this.multiThreading = true;
      }
      if (this.fileType == null || this.fileType == undefined) {
        this.fileType = new Array();
      }
      if (this.useDefTemplate == null || this.useDefTemplate == undefined) {
        this.useDefTemplate = true;
      }
      if (this.selectMultiple == null || this.selectMultiple == undefined) {
        this.selectMultiple = true;
      }
      if (this.knownType == null || this.knownType == undefined) {
        this.knownType = {};
      }
      if (this.selectType == null || this.selectType == undefined) {
        this.selectType = true;
      }
      if (this.dropType == null || this.dropType == undefined) {
        this.dropType = false;
      }
      if (this.pasteType == null || this.pasteType == undefined) {
        this.pasteType = false;
      }
      this.errorTexts = ["浏览器不支持", "超过最大文件数", "文件大小超过限制", "不允许的上传格式"];
      this.errorCode = {
        200: 'warning',
        201: 'deadly'
      }; // warning 普通错误 deadly 致命错误

      this.uploadTotal = 0; // 本次操作被放入的文件数
      this.fileIndex = 0; // 记录总共拖入的文件数
      this.thisFile = 0; // 存放当前文件的资源对象
      this.startTime = 0; // 当前文件的上传开始时间
      this.queue = new Array(); // 用于队列上传
      this.loadOk = 0; // 用于记录当前操作放入的文件被加载成功的数目
      this.time = new Array(); // 用于计算每个文件上传的平均网速
      this.fileCallback = new Array(); //对象数据回调结果

      this.amazeuiUploadDelegateTemplate = new AmazeuiUploadDelegateTemplate(this.useDefTemplate);
      this.context.html(this.amazeuiUploadDelegateTemplate.initContext());
      this.amazeuiUploadDelegateTemplate.init();

      this.amazeuiUploadDelegateEvent = new AmazeuiUploadDelegateEvent(this.amazeuiUploadDelegateTemplate, this.downloadUrl);

      if (this.pasteType) {
        this._pasteFile();
      }
      if (this.dropType) {
        this._dropFile();
      }
      if (this.selectType) {
        this._selectFile();
      }
      return this;
    }
    // 选择上传
  AmazeuiUpload.prototype._selectFile = function() {
      var _this = this;
      var selectFile = $('#selectFile');
      if (selectFile.attr('multiple') == undefined && _this.selectMultiple) {
        selectFile.attr('multiple', 'multiple');
      }
      selectFile.on('change', function() {
        _this._handFiles(this.files);
      });
    }
    // 拖拽上传
  AmazeuiUpload.prototype._dropFile = function(e) {
    var _this = this;
    $.event.props.push("dataTransfer");
    this.context.bind('dragenter', _this._dragenter).bind('dragleave', _this._dragleave).bind('dragover', _this._dragover).bind('drop', function(e) {
      _this._drop(_this, e);
    });
    $(document).bind('drop', _this._dropDefa).bind('dragover', _this._overDefa).bind('dragleave', _this._leaveDefa).bind('dragenter', _this._enterDefa);
  }
  AmazeuiUpload.prototype._pasteFile = function() {
    var _this = this;
    document.addEventListener('paste', function(e) {
      _this._pasteHand(_this, e);
    }, false);
  }


  // 上传完成后调用的
  AmazeuiUpload.prototype._defaultComplete = function(file) {
    var result = this._defaultCompleteAsync(file.responseText);
    if (result != null && result != undefined && result.status) {
      this._defaultCompleteStatus(file, result.status, result.data.id);
    } else {
      this._defaultCompleteStatus(file, false, "");
    }
  }
  AmazeuiUpload.prototype._defaultCompleteAsync = function(callback) {
    var dataObj = null;
    if (callback != null && callback != undefined) {
      try {
        dataObj = eval('(' + callback + ')')
      } catch (e) {
        console.log(e);
      }
      //传递成功，主要标识写入文件集合
      if (dataObj != null && dataObj.status) {
        this.fileCallback.push(dataObj.data.id);
      }
    }
    return dataObj;
  }
  AmazeuiUpload.prototype._defaultCompleteStatus = function(file, status, fileid) {
      var uList = this._dynamicTemplate(file);
      if (status) {
        uList.find('.stage span').removeClass('am-badge-warning').addClass('am-badge-success').html('上传成功');
        uList.find('.fileID').html(fileid);
      } else {
        uList.find('.stage span').removeClass('am-badge-warning').addClass('am-badge-danger').html('上传失败');
      }
      this._defaultCompleteInitButtonEvent(uList, fileid);
      //	uList.find('.am-progress.am-progress-striped.am-active').hide();
    }
    // 上传状态改变时触发
  AmazeuiUpload.prototype._defaultStageChange = function(file) {
      var uList = this._dynamicTemplate(file);
      uList.find('.am-progress').show();
      uList.find('.stage span').html('上传中');
      // console.log(file.index + '正在被上传');
    }
    //获取模版定义
  AmazeuiUpload.prototype._dynamicTemplate = function(file) {
    var uList;
    if (this.useDefTemplate) {
      uList = $('#_template tbody tr').eq(file.index);
    } else {
      uList = $('#_uList li').eq(file.index);
    }
    return uList;
  }
  AmazeuiUpload.prototype._pasteHand = function(_this, e) {
      var clipboard = e.clipboardData;
      var temp = [];
      for (var i = 0; i < clipboard.items.length; i++) {
        temp.push(clipboard.items[i].getAsFile());
      };
      _this._handFiles(temp);
      e.preventDefault();
      e.stopPropagation();
    }
    // 当开启队列上传时可以知道那个文件正在被上传,返回网速及上传百分比
  AmazeuiUpload.prototype._dynamic = function(result) {
    result.thisDom.find('.am-progress-bar.am-progress-bar-secondary').css('width', result.progress + '%').html(result.progress + '%');
    result.thisDom.find('.speed text').text(result.speed + " K\/S");
    result.thisDom.find('.loaded text').text(result.loaded + ' / ' + result.total);
  }

  AmazeuiUpload.prototype._error = function(error, file, i) {
    console.log(eror, file, i);
  }
  AmazeuiUpload.prototype._dragenter = function(e) {
    e.dataTransfer.dropEffect = "copy";
    e.preventDefault();
    e.stopPropagation();
  }
  AmazeuiUpload.prototype._dragleave = function(e) {
    e.dataTransfer.dropEffect = "copy";
    e.preventDefault();
    e.stopPropagation();
  }
  AmazeuiUpload.prototype._dragover = function(e) {
    e.dataTransfer.dropEffect = "copy";
    e.preventDefault();
    e.stopPropagation();
  }
  AmazeuiUpload.prototype._drop = function(_this, e) {
    _this._handFiles(e.dataTransfer.files);
    e.dataTransfer.dropEffect = "copy";
    e.preventDefault();
    e.stopPropagation();
  }
  AmazeuiUpload.prototype._dropDefa = function(e) {
    e.dataTransfer.dropEffect = "none";
    e.preventDefault();
    e.stopPropagation();
  }
  AmazeuiUpload.prototype._enterDefa = function(e) {
    e.dataTransfer.dropEffect = "none";
    e.preventDefault();
    e.stopPropagation();
  }
  AmazeuiUpload.prototype._leaveDefa = function(e) {
    e.dataTransfer.dropEffect = "none";
    e.preventDefault();
    e.stopPropagation();
  }
  AmazeuiUpload.prototype._overDefa = function(e) {
    e.dataTransfer.dropEffect = "none";
    e.preventDefault();
    e.stopPropagation();
  }

  AmazeuiUpload.prototype._complete = function(file) {
    this._defaultComplete(file);
  }
  AmazeuiUpload.prototype._fileStore = function(e) {}
    // 当开启队列上传时可以知道那个文件正在被上传
  AmazeuiUpload.prototype._stageChange = function(file) {
      this._defaultStageChange(file);
    }
    //处理文件
  AmazeuiUpload.prototype._handFiles = function(files) {
      var _this = this;
      var files = _this._sortFiles(files);
      _this.uploadTotal = files.length;
      Array.prototype.push.apply(_this.queue, files);
      for (var i = 0; i < files.length; i++) {
        var code = _this._filter(files[i]);
        if (code == 'deadly') {
          return false;
        } else if (code == 'warning') {
          continue;
        }
        if (files[i].name == undefined) {
          files[i].name = new Date().getTime();
        }
        files[i].index = _this.fileIndex++;
        files[i].stage = 'Waiting';
        _this._readerFile(files[i]);
        _this.thisFile = files[i];
      };
    }
    //文件排序
  AmazeuiUpload.prototype._sortFiles = function(files) {
      var listSize = [];
      for (var i = 0; i < files.length; i++) {
        listSize[i] = files[i];
      };
      for (var i = 0; i < listSize.length; i++) {
        for (var j = i + 1; j < listSize.length; j++) {
          if (listSize[j].size < listSize[i].size) {
            var temp = listSize[j];
            listSize[j] = listSize[i];
            listSize[i] = temp;
          }
        };
      };
      return listSize;
    }
    //计算文件上传进度
  AmazeuiUpload.prototype._progress = function(e, file) {
    if (e.lengthComputable) {
      //计算网速
      var nowDate = new Date().getTime();
      var x = (e.loaded) / 1024;
      var y = (nowDate - this.startTime) / 1000;
      this.time.push((x / y).toFixed(2));
      if ((e.loaded / e.total) * 100 == 100) {
        var avg = 0;
        for (var i = 0; i < this.time.length; i++) {
          avg += parseInt(this.time[i]);
        };
        // 求出平均网速
      }
      var result = {};
      result.thisDom = this._dynamicTemplate(file);
      result.progress = Math.round((e.loaded / e.total) * 100);
      result.speed = (x / y).toFixed(2);
      result.loaded = this.amazeuiUploadDelegateEvent.calculationSize(e.loaded);
      result.total = this.amazeuiUploadDelegateEvent.calculationSize(e.total);
      this._dynamic(result);
    } else {
      alert('无法获得文件大小')
    }
  }
  AmazeuiUpload.prototype._setImageCardModelData = function(file, imageFileReader, img) {
    var data = {};
    data.file = file;
    data.fileReaderiImage = imageFileReader;
    data.newImage = img;
    data.fileSize = this.amazeuiUploadDelegateEvent.calculationSize(file.size);
    data.fileType = this.amazeuiUploadDelegateEvent.calculationFileType(file);
    this.amazeuiUploadDelegateTemplate.setImageCardTemplate(data);
    this.loadOk++;
    if (this.loadOk == this.queue.length && !this.multiThreading) {
      this._upload(this.queue[0]);
    }
    if (this.multiThreading) {
      this._upload(data.file);
    }
  }
  AmazeuiUpload.prototype._setTableModelData = function(file) {
    var data = {};
    data.file = file;
    data.fileSize = this.amazeuiUploadDelegateEvent.calculationSize(file.size);
    data.fileType = this.amazeuiUploadDelegateEvent.calculationFileType(file);
    this.amazeuiUploadDelegateTemplate.createTableRowData(data);

    this.loadOk++;
    if (this.loadOk == this.queue.length && !this.multiThreading) {
      this._upload(this.queue[0]);
    }
    if (this.multiThreading) {
      this._upload(file);
    }
  }

  AmazeuiUpload.prototype._readerFile = function(file) {
    var _this = this;
    var reader = new FileReader();
    reader.addEventListener('load', function(e) {
      _this._switchModel(file, e);
    }, false);
    reader.readAsDataURL(file);
  }
  AmazeuiUpload.prototype._filter = function(file) {
    var type = !file.type ? 'other' : file.type.split('/')[1];
    if (type) {
      var typeIsOk = false;
      if (this.fileType.length > 0) {
        for (var o in this.fileType) {
          if (type == this.fileType[o]) {
            typeIsOk = true;
            break;
          }
        }
        if (!typeIsOk) {
          this._error(this.errorTexts[3], file);
          return this.errorCode['200'];
        }
      }
    }
    if (this.uploadTotal > this.maxFiles) {
      this._error(this.errorTexts[1], file);
      return this.errorCode['201'];
    }
    var max_file_size = 1048576 * this.maxFileSize;
    if (file.size > max_file_size) {
      this._error(this.errorTexts[2], file);
      return this.errorCode['200'];
    }
  }
  AmazeuiUpload.prototype._createXMLHttpRequest = function() {
      if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
      } else {
        var names = ["msxml", "msxml2", "msxml3", "Microsoft"];
        for (var i = 0; i < names.length; i++) {
          try {
            var name = names[i] + ".XMLHTTP";
            return new ActiveXObject(name);
          } catch (e) {}
        }
      }
      return null;
    }
    //切换文件处理方式
  AmazeuiUpload.prototype._switchModel = function(file, e) {
    if (this.useDefTemplate) {
      this._setTableModelData(file);
    } else {
      var type = !file.type ? 'other' : file.type.split('/')[1];
      if (type == 'jpg' || type == 'jpeg' || type == 'png' || type == 'gif' || type == 'bmp' || type == 'x-icon') {
        this._getImageInfo(file, e);
      } else {
        this._setOtherCardModelData(file);
      }
    }
  }
  AmazeuiUpload.prototype._setOtherCardModelData = function(file) {
    var data = {};
    data.file = file;
    data.fileSize = this.amazeuiUploadDelegateEvent.calculationSize(file.size);
    data.fileType = this.amazeuiUploadDelegateEvent.calculationFileType(file);
    this.amazeuiUploadDelegateTemplate.setotherCardTemplate(data);

    var type = data.fileType;
    if (this.knownType[type] != undefined && this.knownType[type] != 'undefined') {
      var thisLi = $('#_uList li').eq(data.file.index);
      thisLi.find('.image img').attr('src', this.knownType[type]);
    }
    this.loadOk++;
    if (this.loadOk == this.queue.length && !this.multiThreading) {
      this._upload(this.queue[0]);
    }
    if (this.multiThreading) {
      this._upload(file);
    }
  }
  AmazeuiUpload.prototype._getImageInfo = function(file, image) {
      var _this = this;
      var img = new Image();
      img.src = image.target.result;
      img.addEventListener('load', function(e) {
        _this._setImageCardModelData(file, image, img);
      }, false);
    }
    //上传文件
  AmazeuiUpload.prototype._upload = function(file) {
      var _this = this;
      file.stage = 'uploading';
      _this._stageChange(file);

      var xhr = _this._createXMLHttpRequest();
      xhr.open('POST', _this.url, true);
      var upload = xhr.upload;
      if (upload) {
        upload.addEventListener('progress', function(e) {
          _this._progress(e, file);
        }, false);
      }
      xhr.addEventListener('readystatechange', function() {
        if (xhr.readyState == 4 && xhr.status == 200) {
          if (!_this.multiThreading) {
            if (_this.queue.length > 1) {
              _this.queue.shift();
              _this.loadOk--;
              _this._upload(_this.queue[0]);
            }
          }
          file.responseText = xhr.responseText;
          _this._complete(file);
        }
      }, false);
      var formData = new FormData();
      formData.append('file', file);
      xhr.send(formData);
      _this.startTime = new Date().getTime();
    }
    /**
     * 绑定上传行按钮事件
     * 移除行及传递成功后的文件索引
     * @param  {[type]} tr   行信息
     * @param  fileID  文件唯一标识
     */
  AmazeuiUpload.prototype._defaultCompleteInitButtonEvent = function(tr, fileID) {
    this.amazeuiUploadDelegateEvent.initEvent(tr, fileID);
  };
  AmazeuiUpload.prototype.init = function() {
    return this._loadData();
  }
  AmazeuiUpload.prototype.destory = function() {
    this.context.html('');
  }
  AmazeuiUpload.prototype.selectResult = function() {
    var _this = this;
    var uList;
    if (_this.useDefTemplate) {
      uList = $('#_template tbody tr.selectDelete');
    } else {
      uList = $('#_uList li.selectDelete');
    }
    uList.find('span.fileID').each(function(index, object) {
      var value = object.textContent;
      _this._remove(_this.fileCallback, value);
    });
    return _this.fileCallback;
  }
  AmazeuiUpload.prototype.setResult = function(data) {
			var fileList=this.amazeuiUploadDelegateEvent.setResult(data);
      //改变索引序列
      this.fileCallback=fileList;
			//改变对象索引
			this.fileIndex = data.length;
  }

  /**
   * 移除数组中相应的对象
   * @param  {[type]} arr  数组
   * @param  {[type]} item 需要移除的对象
   */
  AmazeuiUpload.prototype._remove = function(arr, item) {
      for (var i = arr.length; i--;) {
        if (arr[i] === item) {
          arr.splice(i, 1);
        }
      }
    }
    /**
     * 定义领域的方法初始化
     */
  $.fn.AmazeuiUpload = function(data) {
    if (!data) data = {};
    data.id = this.attr('id');
    data.context = this;
    return new AmazeuiUpload(data).init();
  };

})(jQuery);
