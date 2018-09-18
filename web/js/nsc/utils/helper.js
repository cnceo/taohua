/**
 * 工具 - 帮助类
 * @author ammo
 */
define('utils/helper', function(){

  /**
  * 获取JSON文件
  * @param  {[type]}   url      [路径]
  * @param  {[type]}   toObject [是否转换成对象]
  * @param  {[type]}   refresh  [是否使用本地缓存]
  */
  var loadJson = function(url, toObject, refresh) {

      refresh = refresh || false;

      if (refresh) {

          url += '?r=' + Math.ceil(Math.random() * 999999999);

      };

      $.getJSON(url, null, function(json, textStatus) {

          return toObject ? json : JSON.stringify(json);

      });

  }


  /**
   * [replaceTextByOrder 替换文档 $ 按顺序]
   * @param  {[string]} text   [原文档]
   * @param  {[arr]}    params [替换参数数组]
   * @return {[string]}        [替换后文档]
   */
  var replaceText = function(text, params){

    if (params) {

      var _r = '';
      var paramMap = text.split("$");

      //URL参数组装
      if (paramMap.length > 1) {

        $.each(paramMap, function(index, val) {

          _r += val;
          if (paramMap.length - 1 === index) {
            return
          };
          _r += params[index]

        });

        return _r
      };

    };

    return text;

  }


  return {

    loadJson : loadJson,
    replaceText: replaceText

  }

})
