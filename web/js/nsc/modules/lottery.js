/**
 * 彩票模块相关
 */
define('modules/lottery', ['utils/helper'], function(_){

	/**
	 * [createPlayMethodBtn 生成选择彩种类型按钮]
	 * @return {[void]}        [JQ 生成]
	 */
	var createPlayMethodBtn = function(lotteryId){

		// 以下几种彩票类型才会生成
		var _include = [1, 14, 19, 23];
		if ($.inArray(lotteryId,_include) === -1) {
			return;
		}

		// JQ生成
		var _templete = '<div class="ren"><a href="$">$</a></div>', _params = [];
		_params[0] = ['#rx', '任选玩法'];
		_params[1] = ['#cg', '常规玩法'];

		if (location.hash === '#rx') {

			_templete = _.replaceText(_templete, _params[1]);

		}else{

			_templete = _.replaceText(_templete, _params[0]);

		}

		// OPERATION DOM
		$(".ren").remove();
		$('#lotteryType').after(_templete);

	}



	/**
	 * [filterPlayMethod 筛选彩票类型]
	 * @param  {[type]} arr [所有彩票类型数组对象]
	 * @return {[type]}     [筛选完成之后的数组]
	 */
	var filterPlayMethod = function(arr, lotteryId){

		// 以下几种彩票类型才会生成
		var _include = [1, 14, 19, 23];
		if ($.inArray(lotteryId,_include) === -1) {
			return;
		}

		// 使用隐藏显示的方法来处理
		$('#lotteryType').children().each(function(index, val){
			if (location.hash === '#rx') {
				if ($(val).text().indexOf('任选') !== -1) {
					$(val).show();
					if (arr[index].isdefault === "1") {
						$(val).addClass('category-check')
					}
				}else{
					$(val).hide();
				}
				return true;
			}
			if (location.hash === '#cg') {
				//console.log($(val).text().indexOf('任选') === -1);
				if ($(val).text().indexOf('任选') === -1) {
					$(val).show();
					if (arr[index].isdefault === "1") {
						$(val).addClass('category-check')
					}
				}else{
					$(val).hide();
				}
			}
		})

		// JS点击
		$('#lotteryType').children(":visible").first().click();
		$('#lotteryType').children(":visible").each(function(index, el) {
			if ($(el).attr('class') && $(el).attr('class').indexOf('category-check') !== -1) {
				$(el).click();
			}
		})

	}


	/**
	 * 返回模块
	 */
	return {

		createPlayMethodBtn: createPlayMethodBtn,
		filterPlayMethod	 : filterPlayMethod

	}

});
