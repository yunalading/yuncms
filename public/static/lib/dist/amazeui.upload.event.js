/**
 * @Date 2016-11-09
 * @Author xfworld
 * [AmazeuiUploadDelegateEvent 回写上传数据]
 * @param {[type]} amazeuiUploadDelegateTemplate [模版]
 * @param {[type]} url                   [下载地址]
 */
var AmazeuiUploadDelegateEvent = function AmazeuiUploadDelegateEvent(amazeuiUploadDelegateTemplate, url) {
  this.amazeuiUploadDelegateTemplate = amazeuiUploadDelegateTemplate;
  this.url = url;
}

/**
 * 载入已上传的对象
 * @param {[List]} data [对象]
 */
AmazeuiUploadDelegateEvent.prototype.setResult = function(data) {
    var that = this;
    var array = new Array();
    var content = this.getContent();
    var templateValue=new Array();
    // for data  to struct build to file  into the view
    if (data != null && data != undefined && data.length > 0) {
      $(data).each(function(index, result) {
        var obj = that.writeValue(result);
        templateValue.push(obj.template);
        array.push(obj.file.id);
      });
    }
    content.append(templateValue);
    return array;
  }
  /**
   * 获取内容容器
   * @return dom
   */
AmazeuiUploadDelegateEvent.prototype.getContent = function() {
    var content = null;
    if (this.amazeuiUploadDelegateTemplate.useDefTemplate) {
      content = $('#_template tbody');
    } else {
      content = $('#_uList');
    }
    return content;
  }
  //获取重写的类型模版
AmazeuiUploadDelegateEvent.prototype.getTemplate = function() {
    var template = null;
    if (this.amazeuiUploadDelegateTemplate.useDefTemplate) {
      template = this.amazeuiUploadDelegateTemplate.getTableRowTemplate();
    } else {
      template = this.amazeuiUploadDelegateTemplate.cardTemplate('other');
    }
    return template;
  }
  /**
   * 写入单个数据信息
   * @param  {[type]} data 资源信息
   * @return void
   */
AmazeuiUploadDelegateEvent.prototype.writeValue = function(data) {
  var obj = new Object();
  var template = $(this.getTemplate());
  var file = this.traforData(data);
  if (template != null && file != null) {
    //var last = $(template).children().last();
    template.find('.fileName text').text(file.name);
    template.find('.fileSize text').html(this.calculationSize(file.size));
    template.find('.fileID').html(file.id);
    template.find('.stage span').removeClass('am-badge-warning').addClass('am-badge-success').html('已加载');
    template.find('am-btn').show();
    //绑定下载事件
    this.initEvent(template,file.id);
  }
  obj.file = file;
  obj.template = template;
  return obj;
}
AmazeuiUploadDelegateEvent.prototype.calculationSize = function(size) {
  var filesize = size;
  if (filesize >= 1073741824) {
    filesize = Math.round(filesize / 1073741824 * 100) / 100 + ' GB';
  } else if (filesize >= 1048576) {
    filesize = Math.round(filesize / 1048576 * 100) / 100 + ' MB';
  } else if (filesize >= 1024) {
    filesize = Math.round(filesize / 1024 * 100) / 100 + ' KB';
  } else {
    filesize = filesize + ' Bytes';
  }
  return filesize;
}
//获取文件类型
AmazeuiUploadDelegateEvent.prototype.calculationFileType = function(file) {
  var type = !file.type ? 'other' : file.type.split('/')[1];
  return type;
}
AmazeuiUploadDelegateEvent.prototype.initEvent = function(tr, fileID) {
  var that = this;
  if (tr != null && tr != undefined) {
    tr.find('.am-icon-remove').parent().on('click', function() {
      $(tr).addClass("selectDelete").hide();
    }).show();
    if (fileID != null && fileID != undefined && fileID.length > 0) {
      tr.find('.am-icon-download').parent().on('click', function() {
        that.downloadFile(fileID);
      }).show();
    }
  }
}

AmazeuiUploadDelegateEvent.prototype.downloadFile = function(fileID) {
  if (fileID != null && fileID != undefined && fileID.length > 0) {
    var fileRequestUrl = this.url + "?store=" + fileID;
    var content = this.getContent();
    content.find('iframe').remove();
    var downloadAction = $("<iframe style='display:none'></iframe>").attr({
      "src": fileRequestUrl
    });
    //init downloadAction
    content.append(downloadAction);
  } else {
    // alert  error
    messageBox.errorMessageBox('文件不存在，无法下载');
  }
}
AmazeuiUploadDelegateEvent.prototype.traforData = function(data) {
  var file = null;
  if (data != null && data != undefined && data.id != null) {
    file = new Object();
    file.name = data.resourceName;
    file.size = data.resourceSize;
    file.id = data.fileStoreId;
  }
  return file;
}
