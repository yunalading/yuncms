
/**
 * @Date 2016-11-10
 * @Author xfworld
 * AmazeUI Upload 模版
 * @param true:tableTemplate  false:cardTemplate
 */
var AmazeuiUploadDelegateTemplate = function AmazeuiUploadDelegateTemplate(useDefTemplate) {
  this.useDefTemplate = useDefTemplate;
}

AmazeuiUploadDelegateTemplate.prototype.init = function() {
  if (this.useDefTemplate) {
    this.initTableTemplate();
  }
  return this;
}

AmazeuiUploadDelegateTemplate.prototype.initContext = function() {
  var context = '<div class="am-form-group am-form-file am-upload-toggleBoarder">\
    <button type="button" class="am-btn am-btn-primary am-btn-xs">\
       <i class="am-icon-cloud-upload"></i>选择要上传的文件\
    </button>\
    <input id="selectFile" type="file" multiple />\
    <div class="am-upload-parse">把文件拖这里试试</div>\
  </div>\
  <hr/>\
  <ul width="100%" class="am-avg-sm-1 am-avg-md-3 am-avg-lg-6 am-thumbnails" id="_uList"></ul>\
  <table class="am-table am-table-compact am-table-striped am-table-hover am-text-sm" id="_template"></table>';
  return context;
}
AmazeuiUploadDelegateTemplate.prototype.cardTemplate = function(type) {
  var imageTpl = '<li>\
    <div class="image">\
      <img class="am-thumbnail" src="" alt="">\
    </div>\
    <div class="uploadInfo">\
      <table class="am-table am-table-compact am-table-striped am-table-hover am-text-xs">\
      <tr><td class="am-text-break"><span style="display:none" class="fileID"></span><span class="fileName"><text>-</text></span></td></tr>\
      <tr><td><span class="imageSize">图片尺寸&nbsp;&nbsp;<text>-</text></span></td></tr>\
      <tr><td><span class="fileSize"><span class="am-badge">文件大小<text>-</text></span></span></td></tr>\
      <tr><td class="am-text-break"><span class="fileType"><span class="am-badge">文件类型<text>-</text></span></span></td></tr>\
      <tr><td><span class="speed"><span class="am-badge am-badge-primary">上传速度<text>-</text></span></span></td></tr>\
      <tr><td><span class="loaded"><span class="am-badge am-badge-secondary">上传详情<text>-</text></span></span></td></tr>\
      <tr><td><div class="stage"><span class="am-badge am-badge-warning">初始化</span></div></td></tr>\
      <tr>\
        <td><div class="am-progress am-progress-striped am-active" style="display:none">\
          <div class="am-progress-bar am-progress-bar-secondary"  style="width: 40%;" >40%</div></div>\
        </td>\
      </tr>\
      <tr><td class="am-text-middle"><button type="button" class="am-btn am-btn-danger am-round am-btn-xs"><i class="am-icon-remove"></i>移除</button><button type="button" class="am-btn am-btn-primary am-round am-btn-xs"><i class="am-icon-download"></i>下载</button></td></tr>\
      </table>\
    </div>\
  </li>';
  var otherTpl = '<li>\
    <div class="uploadInfo">\
      <table class="am-table am-table-compact am-table-striped am-table-hover am-text-xs">\
        <tr><td class="am-text-break"><span style="display:none" class="fileID"></span><span class="fileName"><text>-</text></span></td></tr>\
        <tr><td><span class="fileSize"><span class="am-badge">文件大小<text>-</text></span></span></td></tr>\
        <tr><td class="am-text-break"><span class="fileType">文件类型<text>-</text></span></td></tr>\
        <tr><td><span class="speed"><span class="am-badge am-badge-primary">上传速度<text>-</text></span></span></td></tr>\
        <tr><td><span class="loaded"><span class="am-badge am-badge-secondary">上传详情<text>-</text></span></span></td></tr>\
        <tr><td><div class="stage"><span class="am-badge am-badge-warning">初始化</span></div></td></tr>\
        <tr>\
          <td><div class="am-progress am-progress-striped am-active" style="display:none">\
            <div class="am-progress-bar am-progress-bar-secondary"  style="width: 40%;" >40%</div></div>\
          </td>\
        </tr>\
        <tr class="am-text-middle"><td><button type="button" class="am-btn am-btn-danger am-round am-btn-xs"><i class="am-icon-remove"></i>移除</button><button type="button" class="am-btn am-btn-primary am-round am-btn-xs"><i class="am-icon-download"></i>下载</button></td></tr>\
      </table>\
    </div>\
  </li>';
  if (type == 'image') {
    return imageTpl;
  } else if (type == 'other') {
    return otherTpl;
  }
}
AmazeuiUploadDelegateTemplate.prototype.initTableTemplate = function() {
    var th = '<thead><tr><th>文件信息</th><th>上传情况</th><th>上传状态</th><th>操作项</th></tr></thead><tbody></tbody>';
    $('#_template').append(th);
  }
  // 设置图片类型文件View模板
AmazeuiUploadDelegateTemplate.prototype.setImageCardTemplate = function(data) {
    var tpl = this.cardTemplate('image');
    //		console.log(data.file.name+" :"+data.fileType);
    $('#_uList').append(tpl);
    var thisLi = $('#_uList li').last();
    //eq(data.file.index);
    thisLi.find('.image img').attr('src', data.fileReaderiImage.target.result).each(function() {
      if ($(this).width() > $(this).parent().width()) {
        $(this).width("100%");
      }
    });
    thisLi.find('.fileName text').text(data.file.name);
    thisLi.find('.imageSize text').text(data.newImage.width + ' X ' + data.newImage.height);
    thisLi.find('.fileSize text').text(data.fileSize);
    thisLi.find('.fileType text').text(data.fileType);
  }
  // 设置其他文件类型View模板
AmazeuiUploadDelegateTemplate.prototype.setotherCardTemplate = function(data) {
  //	 console.log(data.file.name+" :"+data.fileType);
  var tpl = this.cardTemplate('other');
  $('#_uList').append(tpl);
  var thisLi = $('#_uList li').last();
  //.eq(data.file.index);
  thisLi.find('.fileName text').text(data.file.name);
  thisLi.find('.fileSize text').text(data.fileSize);
  thisLi.find('.fileType text').text(data.fileType);
}

//设定默认模版行
AmazeuiUploadDelegateTemplate.prototype.getTableRowTemplate = function() {
    var rowTemplate = '<tr>\
      <td width="40%">\
        <span style="display:none" class="fileID"></span>\
        <span class="fileName"><label class="am-text-xs"><text>-</text><label></span><br/>\
        <span class="fileSize"><span class="am-badge">文件大小<text>-</text></span></span>\
      </td>\
      <td width="20%">\
        <span class="speed"><span class="am-badge am-badge-primary">速度<text>-</text></span></span><br />\
        <span class="loaded"><span class="am-badge am-badge-secondary">详情<text>-</text></span></span>\
      </td>\
      <td width="30%">\
      <div class="stage"><span class="am-badge am-badge-warning">初始化</span></div>\
      <div class="am-progress am-progress-striped am-active" style="display:none">\
        <div class="am-progress-bar am-progress-bar-secondary"  style="width: 10%;" >10%</div>\
      </div>\
      </td>\
      <td width="10%" class="am-text-middle"><button type="button" class="am-btn am-btn-danger am-round am-btn-xs"><i class="am-icon-remove"></i>移除</button><button type="button" class="am-btn am-btn-primary am-round am-btn-xs"><i class="am-icon-download"></i>下载</button></td>\
      </tr>';
    return rowTemplate;
  }
  //创建默认模版行记录
AmazeuiUploadDelegateTemplate.prototype.createTableRowData = function(data) {
  var tpl = this.getTableRowTemplate();
  $('#_template tbody').append(tpl);
  var thisLi = $('#_template tbody tr').eq(data.file.index);
  thisLi.find('.fileName text').text(data.file.name);
  thisLi.find('.fileSize text').text(data.fileSize);
  thisLi.find('am-btn').hide();
}
