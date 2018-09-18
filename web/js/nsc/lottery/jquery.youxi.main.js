/*
* lottery of highgame
*
* version: 1.0.0 (01/21/2010)
* @ jQuery v1.3 or later ,suggest use 1.4
*
* Copyright 2010 James [ jameskerr2009[at]gmail.com ]
*
*/
var is_select=0;
;(function($){//start
    //check the version, need 1.3 or later , suggest use 1.4
    if (/^1.2/.test($.fn.jquery) || /^1.1/.test($.fn.jquery)) {
    	alert('requires jQuery v1.3 or later !  You are using v' + $.fn.jquery);
    	return;
    }
    $.gameInit = function(opts){//整个购彩界面的初始化
        var ps = {//整个JS的初试化默认参数
            data_label      : [],
            data_id : {
                        id_cur_issue    : '#current_issue',//装载当前期的ID
                        id_cur_end      : '#current_endtime',//装载当前期结束时间的ID
                        //id_count_down   : '#count_down',//装载倒计时的ID
						//id_labelbox     : '#lt_big_label', //装载大标签的元素ID
                        id_labelbox     : '#lotteryType', //装载大标签的元素ID(原来的是:lt_big_label)
                        id_smalllabel   : '#lt_small_label',//装载小标签的元素ID
						id_funding 		: '#lt_funding',//元角分控制
                        id_methoddesc   : '#lt_desc',//装载玩法描述的ID
                        id_methodhelp   : '#lt_help',//玩法帮助
                        id_helpdiv      : '#lt_help_div',//玩法帮助弹出框
                        id_selector     : '#lt_selector',//装载选号区的ID
                        id_sel_num      : '#lt_sel_nums',//装载选号区投注倍数的ID
                        id_sel_money    : '#lt_sel_money',//装载选号区投注金额的ID
                        id_sel_times    : '#lt_sel_times',//选号区倍数输入框ID
                        id_sel_insert   : '#lt_sel_insert',//添加按钮
                        id_sel_modes    : '#lt_sel_modes',//元角模式选择
                        id_cf_count     : '#lt_cf_count', //统计投注单数
                        id_cf_clear     : '#lt_cf_clear', //清空确认区数据的按钮ID
                        id_cf_content   : '#lt_cf_content',//装载确认区数据的TABLE的ID
                        id_cf_num       : '#lt_cf_nums',//装载确认区总投注注数的ID
                        id_cf_money     : '#lt_cf_money',//装载确认区总投注金额的ID
                        id_issues       : '#lt_issues',//装载起始期的ID
                        id_sendok       : '#lt_sendok',  //立即购买按钮
                        id_tra_if       : '#lt_trace_if',//是否追号的div
                        id_tra_ifb      : '#lt_trace_if_button',//是否追号的hidden input
                        id_tra_stop     : '#lt_trace_stop',//是否追中即停的checkbox ID
                        id_tra_box1     : '#lt_trace_box1',//装载整个追号内容的ID，主要是隐藏和显示
                        id_tra_today    : '#lt_trace_today',//今天按钮的ID
                        id_tra_tom      : '#lt_trace_tomorrow',//明天按钮的ID
                        id_tra_alct     : '#lt_trace_alcount',//装载可追号期数的ID
                        id_tra_label    : '#lt_trace_label',//装载同倍，翻倍，利润追号等元素的ID
                        id_tra_lhtml    : '#lt_trace_labelhtml',//装载同倍翻倍等标签所表示的内容
                        id_tra_ok       : '#lt_trace_ok',//立即生成按钮
                        id_tra_issues   : '#lt_trace_issues',//装载追号的一系列期数的ID
                        id_beishuselect : '#lt_beishuselect',//jack 增加的下拉框选择倍数ID
                        id_methodexample: '#lt_example',//玩法示例
                        id_examplediv: '#lt_example_div',//玩法示例弹出框
                        id_random_area: '#lt_random_area',//随机选号
						id_changetype : '#changeLotteryType',
						id_poschoose : '#poschoose'//任选玩法万千百十个容器                         
                    },

            cur_issue : {issue:'20100210-001',endtime:'2010-02-10 09:10:00'},  //当前期
            issues    : {//所有的可追号期数集合
                         today:[],
                         tomorrow: []
                        },
            servertime : '2010-02-10 09:09:40',//服务器时间[与服务器同步]
            ajaxurl    : '',    //提交的URL地址,获取下一期的地址是后面加上flag=read,提交是后面加上flag=save
            lotteryid  : 1,//彩种ID
            ontimeout  : function(){},//时间结束后执行的函数
            onfinishbuy: function(){},//购买成功后调用的函数
            test : ''
        }
        opts = $.extend( {}, ps, opts || {} ); //根据参数初始化默认配置
        /*************************************全局参数配置 **************************/
		$.extend({
			lt_id_data : opts.data_id,
			lt_method_data : {},//当前所选择的玩法数据
			lt_method : {
			
			2:'ZX3',3:'ZXHZ',5:'ZX3',6:'ZXHZ',8:'ZUS',9:'ZUL',10:'HHZX',11:'ZUHZ',13:'ZUS',14:'ZUL',15:'HHZX',16:'ZUHZ',18:'BDW1',20:'BDW2',513:'BDW2',22:'ZX2',26:'ZU2',24:'ZX2',28:'ZU2',30:'DWD',31:'DWD',32:'DWD',33:'DWD',34:'DWD',36:'DXDS',38:'DXDS',
			89:'ZX3',92:'ZXHZ',102:'ZX3',103:'ZXHZ',104:'ZUS',105:'ZUL',106:'HHZX',107:'ZUHZ',108:'ZUS',109:'ZUL',110:'HHZX',111:'ZUHZ',112:'BDW1',113:'BDW2',114:'ZX2',115:'ZX2',116:'ZU2',117:'ZU2',118:'DWD',119:'DWD',120:'DWD',121:'DWD',122:'DWD',123:'DXDS',124:'DXDS',
			126:'ZX3',127:'ZXHZ',129:'ZX3',130:'ZXHZ',132:'ZUS',133:'ZUL',134:'HHZX',135:'ZUHZ',137:'ZUS',138:'ZUL',139:'HHZX',140:'ZUHZ',142:'BDW1',144:'BDW2',146:'ZX2',148:'ZX2',150:'ZU2',152:'ZU2',154:'DWD',155:'DWD',156:'DWD',157:'DWD',158:'DWD',160:'DXDS',162:'DXDS',
			265:'ZX3',266:'ZXHZ',268:'ZX3',269:'ZXHZ',271:'ZUS',272:'ZUL',273:'HHZX',274:'ZUHZ',276:'ZUS',277:'ZUL',278:'HHZX',279:'ZUHZ',281:'BDW1',283:'BDW2',285:'ZX2',287:'ZX2',289:'ZU2',291:'ZU2',293:'DWD',294:'DWD',295:'DWD',296:'DWD',297:'DWD',299:'DXDS',301:'DXDS',
			189:'ZX3',190:'ZXHZ',192:'ZUS',193:'ZUL',194:'HHZX',195:'ZUHZ',197:'BDW1',199:'ZX2',201:'ZX2',203:'ZU2',205:'ZU2',261:'DWD',262:'DWD',263:'DWD',472:'ZXHZ2',474:'ZXHZ2',476:'ZUHZ2',478:'ZUHZ2',//上海时时乐
			220:'SDZX3',222:'SDZU3',224:'SDZX2',226:'SDZU2',228:'SDBDW',230:'SDDWD',231:'SDDWD',232:'SDDWD',234:'SDDDS',236:'SDCZW',238:'SDRX1',240:'SDRX2',243:'SDRX3',246:'SDRX4',249:'SDRX5',252:'SDRX6',255:'SDRX7',258:'SDRX8',
			303:'SDZX3',305:'SDZU3',307:'SDZX2',309:'SDZU2',311:'SDBDW',313:'SDDWD',314:'SDDWD',315:'SDDWD',317:'SDDDS',319:'SDCZW',321:'SDRX1',323:'SDRX2',325:'SDRX3',327:'SDRX4',329:'SDRX5',331:'SDRX6',333:'SDRX7',335:'SDRX8',
			337:'SDZX3',339:'SDZU3',341:'SDZX2',343:'SDZU2',345:'SDBDW',347:'SDDWD',348:'SDDWD',349:'SDDWD',351:'SDDDS',353:'SDCZW',355:'SDRX1',357:'SDRX2',359:'SDRX3',361:'SDRX4',363:'SDRX5',365:'SDRX6',367:'SDRX7',369:'SDRX8',
			393:'SDZX3',395:'SDZU3',397:'SDZX2',399:'SDZU2',401:'SDBDW',403:'SDDWD',404:'SDDWD',405:'SDDWD',407:'SDDDS',409:'SDCZW',411:'SDRX1',413:'SDRX2',415:'SDRX3',417:'SDRX4',419:'SDRX5',421:'SDRX6',423:'SDRX7',425:'SDRX8',
			2304:'BJRX1',2305:'BJRX2',2306:'BJRX3',2307:'BJRX4',2308:'BJRX5',2309:'BJRX6',2310:'BJRX7',385:'BJHZDS',387:'BJHZDX',389:'BJSXP',391:'BJJOP',427:'BJDXDS',//北京快乐8
			2274:'ZX5',2267:'ZH4',2265:'ZX4',2269:'SXZU24',2270:'SXZU12',2271:'SXZU6',2272:'SXZU4',2276:'ZH5',
                        2278:'WXZU120',2279:'WXZU60',  2280:'WXZU30',2281:'WXZU20',2282:'WXZU10',2283:'WXZU5',2285:'BDW1',2286:'HSCS',2287:'SXBX',2288:'SJFC',2291:'ZX3',2292:'ZXHZ',2293:'ZUS',2294:'ZUL',2295:'HHZX',2296:'ZUHZ',
			1189:'ZX3',1190:'ZXHZ',1192:'ZUS',1193:'ZUL',1194:'HHZX',1195:'ZUHZ',1197:'BDW1',1199:'ZX2',1201:'ZX2',1203:'ZU2',1205:'ZU2',1261:'DWD',1262:'DWD',1263:'DWD',//福彩3D
			2189:'ZX3',2190:'ZXHZ',2192:'ZUS',2193:'ZUL',2194:'HHZX',2195:'ZUHZ',2197:'BDW1',2199:'ZX2',2201:'ZX2',2203:'ZU2',2205:'ZU2',2261:'DWD',2262:'DWD',2263:'DWD',
			//天津时时彩
            2324:'ZX3',2325:'ZXHZ',2326:'ZX3',2327:'ZXHZ',2328:'ZUS',2329:'ZUL',2330:'HHZX',2331:'ZUHZ',2332:'ZUS',2333:'ZUL',2334:'HHZX',2335:'ZUHZ',2336:'DBW1',2337:'BDW2',2338:'ZX2',2339:'ZX2',2340:'ZU2',2341:'ZU2',2342:'DWD',2343:'DWD',2344:'DWD',2345:'DWD',2346:'DWD',2347:'DXDS',2348:'DXDS',
			//江苏k3
			2433:'ETHDX',2434:'ETHFX',2435:'SBTH',2436:'SBTHDT',2437:'SBTHHZ',2438:'SBTHTX',2439:'STHDX',2440:'STHTX',2441:'KSHZ',2442:'EBTH',2443:'EBTHDT',
			//越南五分彩
			2368:'ZX3',2369:'ZXHZ',2370:'ZX3',2371:'ZXHZ',2372:'ZUS',2373:'ZUL',2374:'HHZX',2375:'ZU3BD',2376:'ZUHZ',2377:'ZUS',2378:'ZUL',2379:'HHZX',2380:'ZUHZ',2381:'ZU3BD',2382:'BDW1',2383:'BDW1',2384:'BDW2',2385:'BDW2',2386:'ZX2',2387:'ZX2',2388:'ZXHZ2',2389:'ZXHZ2',2390:'ZU2',2391:'ZU2',2392:'ZUHZ2',2393:'ZUHZ2',2394:'DWD',2395:'DWD',2396:'DWD',2397:'DWD',2398:'DWD',2399:'DXDS',2400:'DXDS',2401:'ZX4',2402:'ZH4',2403:'SXZU24',2404:'SXZU12',2405:'SXZU6',2406:'SXZU4',2407:'ZX5',2408:'ZH5',2409:'WXZU120',2410:'WXZU60',2411:'WXZU30',2412:'WXZU20',2413:'WXZU10',2414:'WXZU5',2415:'BDW1',2416:'HSCS',2417:'SXBX',2418:'SJFC',2419:'ZX3',2420:'ZXHZ',2421:'ZUS',2422:'ZUL',2423:'HHZX',2424:'ZUHZ',

			//任选二-直选复式
			1010101:"RXZXSSC2",1010102:"RXZXSSC2",1010103:"RXZXSSC2",1010104:"RXZXSSC2",1010105:"RXZXSSC2",1010106:"RXZXSSC2",1010107:"RXZXSSC2",1010108:"RXZXSSC2",1010109:"RXZXSSC2",1010110:"RXZXSSC2",
			//任选二-直选单式
			1010111:'RXZXSSC2DS',1010112:'RXZXSSC2DS',1010113:'RXZXSSC2DS',1010114:'RXZXSSC2DS',1010115:'RXZXSSC2DS',1010116:'RXZXSSC2DS',1010117:'RXZXSSC2DS',1010118:'RXZXSSC2DS',1010119:'RXZXSSC2DS',1010120:'RXZXSSC2DS',
			//任选二-直选和值
			1010121:'RXZXSSC2HZ',1010122:'RXZXSSC2HZ',1010123:'RXZXSSC2HZ',1010124:'RXZXSSC2HZ',1010125:'RXZXSSC2HZ',1010126:'RXZXSSC2HZ',1010127:'RXZXSSC2HZ',1010128:'RXZXSSC2HZ',1010129:'RXZXSSC2HZ',1010130:'RXZXSSC2HZ',
			
			//任选二-组选复式
			1010201:"RXZUSSC2",1010202:"RXZUSSC2",1010203:"RXZUSSC2",1010204:"RXZUSSC2",1010205:"RXZUSSC2",1010206:"RXZUSSC2",1010207:"RXZUSSC2",1010208:"RXZUSSC2",1010209:"RXZUSSC2",1010210:"RXZUSSC2",
			//任选二-组选单式
			1010211:'RXZUSSC2DS',1010212:'RXZUSSC2DS',1010213:'RXZUSSC2DS',1010214:'RXZUSSC2DS',1010215:'RXZUSSC2DS',1010216:'RXZUSSC2DS',1010217:'RXZUSSC2DS',1010218:'RXZUSSC2DS',1010219:'RXZUSSC2DS',1010220:'RXZUSSC2DS',
			//任选二-组选和值
			1010221:'RXZUSSC2HZ',1010222:'RXZUSSC2HZ',1010223:'RXZUSSC2HZ',1010224:'RXZUSSC2HZ',1010225:'RXZUSSC2HZ',1010226:'RXZUSSC2HZ',1010227:'RXZUSSC2HZ',1010228:'RXZUSSC2HZ',1010229:'RXZUSSC2HZ',1010230:'RXZUSSC2HZ',
			
			//任选三直选复式
			1010301 : 'RXZXSSC3',1010302 : 'RXZXSSC3',1010303 : 'RXZXSSC3',1010304 : 'RXZXSSC3',1010305 : 'RXZXSSC3',1010306 : 'RXZXSSC3',1010307 : 'RXZXSSC3',1010308 : 'RXZXSSC3',1010309 : 'RXZXSSC3',1010310 : 'RXZXSSC3',
			//任选三直选单式
			1010311 : 'RXZXSSC3DS',1010312 : 'RXZXSSC3DS',1010313 : 'RXZXSSC3DS',1010314 : 'RXZXSSC3DS',1010315 : 'RXZXSSC3DS',1010316 : 'RXZXSSC3DS',1010317 : 'RXZXSSC3DS',1010318 : 'RXZXSSC3DS',1010319 : 'RXZXSSC3DS',1010320 : 'RXZXSSC3DS',
			//任选三直选和值
			1010321 : 'RXZXSSC3HZ',1010322 : 'RXZXSSC3HZ',1010323 : 'RXZXSSC3HZ',1010324 : 'RXZXSSC3HZ',1010325 : 'RXZXSSC3HZ',1010326 : 'RXZXSSC3HZ',1010327 : 'RXZXSSC3HZ',1010328 : 'RXZXSSC3HZ',1010329 : 'RXZXSSC3HZ',1010330 : 'RXZXSSC3HZ',
			//任选三组选三
			1010401 : 'RXZUSANSSC3',1010402 : 'RXZUSANSSC3',1010403 : 'RXZUSANSSC3',1010404 : 'RXZUSANSSC3',1010405 : 'RXZUSANSSC3',1010406 : 'RXZUSANSSC3',1010407 : 'RXZUSANSSC3',1010408 : 'RXZUSANSSC3',1010409 : 'RXZUSANSSC3',1010410 : 'RXZUSANSSC3',
			//任选三组选六
			1010411 : 'RXZUSIXSSC3',1010412 : 'RXZUSIXSSC3',1010413 : 'RXZUSIXSSC3',1010414 : 'RXZUSIXSSC3',1010415 : 'RXZUSIXSSC3',1010416 : 'RXZUSIXSSC3',1010417 : 'RXZUSIXSSC3',1010418 : 'RXZUSIXSSC3',1010419 : 'RXZUSIXSSC3',1010420 : 'RXZUSIXSSC3',
			//任选三混合组选
			1010421 : 'RXZUSSC3HH',1010422 : 'RXZUSSC3HH',1010423 : 'RXZUSSC3HH',1010424 : 'RXZUSSC3HH',1010425 : 'RXZUSSC3HH',1010426 : 'RXZUSSC3HH',1010427 : 'RXZUSSC3HH',1010428 : 'RXZUSSC3HH',1010429 : 'RXZUSSC3HH',1010430 : 'RXZUSSC3HH',
			//任选三组选和值
			1010431 : 'RXZUSSC3HZ',1010432 : 'RXZUSSC3HZ',1010433 : 'RXZUSSC3HZ',1010434 : 'RXZUSSC3HZ',1010435 : 'RXZUSSC3HZ',1010436 : 'RXZUSSC3HZ',1010437 : 'RXZUSSC3HZ',1010438 : 'RXZUSSC3HZ',1010439 : 'RXZUSSC3HZ',1010440 : 'RXZUSSC3HZ',
			//任选四直选复式
			1010501 : 'RXZXSSC4',1010502 : 'RXZXSSC4',1010503 : 'RXZXSSC4',1010504 : 'RXZXSSC4',1010505 : 'RXZXSSC4',
			//任选四直选单式
			1010506 : 'RXZXSSC4DS',1010507 : 'RXZXSSC4DS',1010508 : 'RXZXSSC4DS',1010509 : 'RXZXSSC4DS',1010510 : 'RXZXSSC4DS',
			//任选四组选24
			1010601 : 'RXZU24SSC4',1010602 : 'RXZU24SSC4',1010603 : 'RXZU24SSC4',1010604 : 'RXZU24SSC4',1010605 : 'RXZU24SSC4',
			//任选四组选12
			1010606 : 'RXZU12SSC4',1010607 : 'RXZU12SSC4',1010608 : 'RXZU12SSC4',1010609 : 'RXZU12SSC4',1010610 : 'RXZU12SSC4',
			//任选四组选6
			1010611 : 'RXZU6SSC4',1010612 : 'RXZU6SSC4',1010613 : 'RXZU6SSC4',1010614 : 'RXZU6SSC4',1010615 : 'RXZU6SSC4',
			//任选四组选4
			1010616 : 'RXZU4SSC4',1010617 : 'RXZU4SSC4',1010618 : 'RXZU4SSC4',1010619 : 'RXZU4SSC4',1010620 : 'RXZU4SSC4',

            //五分彩
            //任选二-直选复式
            3010101:"RXZXWFC2",3010102:"RXZXWFC2",3010103:"RXZXWFC2",3010104:"RXZXWFC2",3010105:"RXZXWFC2",3010106:"RXZXWFC2",3010107:"RXZXWFC2",3010108:"RXZXWFC2",3010109:"RXZXWFC2",3010110:"RXZXWFC2",
            //任选二-组选复式
            3010201:"RXZUWFC2",3010202:"RXZUWFC2",3010203:"RXZUWFC2",3010204:"RXZUWFC2",3010205:"RXZUWFC2",3010206:"RXZUWFC2",3010207:"RXZUWFC2",3010208:"RXZUWFC2",3010209:"RXZUWFC2",3010230:"RXZUWFC2",
            //任选二-直选单式
            3010111:'RXZXWFC2DS',3010112:'RXZXWFC2DS',3010113:'RXZXWFC2DS',3010114:'RXZXWFC2DS',3010115:'RXZXWFC2DS',3010116:'RXZXWFC2DS',3010117:'RXZXWFC2DS',3010118:'RXZXWFC2DS',3010119:'RXZXWFC2DS',3010120:'RXZXWFC2DS',
            //任选二-组选单式
            3010211:'RXZUWFC2DS',3010212:'RXZUWFC2DS',3010213:'RXZUWFC2DS',3010214:'RXZUWFC2DS',3010215:'RXZUWFC2DS',3010216:'RXZUWFC2DS',3010217:'RXZUWFC2DS',3010218:'RXZUWFC2DS',3010219:'RXZUWFC2DS',3010220:'RXZUWFC2DS',
            //任选二-直选和值
            3010121:'RXZXWFC2HZ',3010122:'RXZXWFC2HZ',3010123:'RXZXWFC2HZ',3010124:'RXZXWFC2HZ',3010125:'RXZXWFC2HZ',3010126:'RXZXWFC2HZ',3010127:'RXZXWFC2HZ',3010128:'RXZXWFC2HZ',3010129:'RXZXWFC2HZ',3010130:'RXZXWFC2HZ',
            //任选二-组选和值
            3010221:'RXZUWFC2HZ',3010222:'RXZUWFC2HZ',3010223:'RXZUWFC2HZ',3010224:'RXZUWFC2HZ',3010225:'RXZUWFC2HZ',3010226:'RXZUWFC2HZ',3010227:'RXZUWFC2HZ',3010228:'RXZUWFC2HZ',3010229:'RXZUWFC2HZ',3010230:'RXZUWFC2HZ',
            //任选三直选复式
            3010301 : 'RXZXWFC3',3010302 : 'RXZXWFC3',3010303 : 'RXZXWFC3',3010304 : 'RXZXWFC3',3010305 : 'RXZXWFC3',3010306 : 'RXZXWFC3',3010307 : 'RXZXWFC3',3010308 : 'RXZXWFC3',3010309 : 'RXZXWFC3',3010310 : 'RXZXWFC3',
            //任选三直选单式
            3010311 : 'RXZXWFC3DS',3010312 : 'RXZXWFC3DS',3010313 : 'RXZXWFC3DS',3010314 : 'RXZXWFC3DS',3010315 : 'RXZXWFC3DS',3010316 : 'RXZXWFC3DS',3010317 : 'RXZXWFC3DS',3010318 : 'RXZXWFC3DS',3010319 : 'RXZXWFC3DS',3010320 : 'RXZXWFC3DS',
            //任选三直选和值
            3010321 : 'RXZXWFC3HZ',3010322 : 'RXZXWFC3HZ',3010323 : 'RXZXWFC3HZ',3010324 : 'RXZXWFC3HZ',3010325 : 'RXZXWFC3HZ',3010326 : 'RXZXWFC3HZ',3010327 : 'RXZXWFC3HZ',3010328 : 'RXZXWFC3HZ',3010329 : 'RXZXWFC3HZ',3010330 : 'RXZXWFC3HZ',
            //任选三组选三
            3010401 : 'RXZUSANWFC3',3010402 : 'RXZUSANWFC3',3010403 : 'RXZUSANWFC3',3010404 : 'RXZUSANWFC3',3010405 : 'RXZUSANWFC3',3010406 : 'RXZUSANWFC3',3010407 : 'RXZUSANWFC3',3010408 : 'RXZUSANWFC3',3010409 : 'RXZUSANWFC3',3010410 : 'RXZUSANWFC3',
            //任选三组选六
            3010411 : 'RXZUSIXWFC3',3010412 : 'RXZUSIXWFC3',3010413 : 'RXZUSIXWFC3',3010414 : 'RXZUSIXWFC3',3010415 : 'RXZUSIXWFC3',3010416 : 'RXZUSIXWFC3',3010417 : 'RXZUSIXWFC3',3010418 : 'RXZUSIXWFC3',3010419 : 'RXZUSIXWFC3',3010420 : 'RXZUSIXWFC3',
            //任选三混合组选
            3010421 : 'RXZUWFC3HH',3010422 : 'RXZUWFC3HH',3010423 : 'RXZUWFC3HH',3010424 : 'RXZUWFC3HH',3010425 : 'RXZUWFC3HH',3010426 : 'RXZUWFC3HH',3010427 : 'RXZUWFC3HH',3010428 : 'RXZUWFC3HH',3010429 : 'RXZUWFC3HH',3010430 : 'RXZUWFC3HH',
            //任选三组选和值
            3010431 : 'RXZUWFC3HZ',3010432 : 'RXZUWFC3HZ',3010433 : 'RXZUWFC3HZ',3010434 : 'RXZUWFC3HZ',3010435 : 'RXZUWFC3HZ',3010436 : 'RXZUWFC3HZ',3010437 : 'RXZUWFC3HZ',3010438 : 'RXZUWFC3HZ',3010439 : 'RXZUWFC3HZ',3010440 : 'RXZUWFC3HZ',
            //任选四直选复式
            3010501 : 'RXZXWFC4',3010502 : 'RXZXWFC4',3010503 : 'RXZXWFC4',3010504 : 'RXZXWFC4',3010505 : 'RXZXWFC4',
            //任选四直选单式
            3010506 : 'RXZXWFC4DS',3010507 : 'RXZXWFC4DS',3010508 : 'RXZXWFC4DS',3010509 : 'RXZXWFC4DS',3010510 : 'RXZXWFC4DS',
            //任选四组选24
            3010601 : 'RXZU24WFC4',3010602 : 'RXZU24WFC4',3010603 : 'RXZU24WFC4',3010604 : 'RXZU24WFC4',3010605 : 'RXZU24WFC4',
            //任选四组选12
            3010606 : 'RXZU12WFC4',3010607 : 'RXZU12WFC4',3010608 : 'RXZU12WFC4',3010609 : 'RXZU12WFC4',3010610 : 'RXZU12WFC4',
            //任选四组选6
            3010611 : 'RXZU6WFC4',3010612 : 'RXZU6WFC4',3010613 : 'RXZU6WFC4',3010614 : 'RXZU6WFC4',3010615 : 'RXZU6WFC4',
            //任选四组选4
            3010616 : 'RXZU4WFC4',3010617 : 'RXZU4WFC4',3010618 : 'RXZU4WFC4',3010619 : 'RXZU4WFC4',3010620 : 'RXZU4WFC4',

			//泰国分分彩
			190101:'ZX3',190102:'ZXHZ',190201:'ZX3',190202:'ZXHZ',190301:'ZUS',190302:'ZUL',190303:'HHZX',190304:'ZUHZ',190401:'ZUS',190402:'ZUL',190403:'HHZX',190404:'ZUHZ',190501:'BDW1',190502:'BDW1',190601:'BDW2',190602:'BDW2',190701:'ZX2',190702:'ZX2',190703:'ZXHZ2',190704:'ZXHZ2',190801:'ZU2',190802:'ZU2',190803:'ZUHZ2',190804:'ZUHZ2',190901:'DWD',190902:'DWD',190903:'DWD',190904:'DWD',190905:'DWD',191001:'DXDS',191002:'DXDS',191101:'ZX4',191201:'ZH4',191301:'SXZU24',191302:'SXZU12',191303:'SXZU6',191304:'SXZU4',191401:'ZX5',191501:'ZH5',191601:'WXZU120',191602:'WXZU60',191603:'WXZU30',191604:'WXZU20',191605:'WXZU10',191606:'WXZU5',191701:'BDW1',191702:'HSCS',191703:'SXBX',191704:'SJFC',191801:'ZX3',191802:'ZXHZ',191901:'ZUS',191902:'ZUL',191903:'HHZX',191904:'ZUHZ',
            //任选二-直选复式
            3110101:"RXZXFFC2",3110102:"RXZXFFC2",3110103:"RXZXFFC2",3110104:"RXZXFFC2",3110105:"RXZXFFC2",3110106:"RXZXFFC2",3110107:"RXZXFFC2",3110108:"RXZXFFC2",3110109:"RXZXFFC2",3110110:"RXZXFFC2",
            //任选二-组选复式
            3110201:"RXZUFFC2",3110202:"RXZUFFC2",3110203:"RXZUFFC2",3110204:"RXZUFFC2",3110205:"RXZUFFC2",3110206:"RXZUFFC2",3110207:"RXZUFFC2",3110208:"RXZUFFC2",3110209:"RXZUFFC2",3110230:"RXZUFFC2",
            //任选二-直选单式
            3110111:'RXZXFFC2DS',3110112:'RXZXFFC2DS',3110113:'RXZXFFC2DS',3110114:'RXZXFFC2DS',3110115:'RXZXFFC2DS',3110116:'RXZXFFC2DS',3110117:'RXZXFFC2DS',3110118:'RXZXFFC2DS',3110119:'RXZXFFC2DS',3110120:'RXZXFFC2DS',
            //任选二-组选单式
            3110211:'RXZUFFC2DS',3110212:'RXZUFFC2DS',3110213:'RXZUFFC2DS',3110214:'RXZUFFC2DS',3110215:'RXZUFFC2DS',3110216:'RXZUFFC2DS',3110217:'RXZUFFC2DS',3110218:'RXZUFFC2DS',3110219:'RXZUFFC2DS',3110220:'RXZUFFC2DS',
            //任选二-直选和值
            3110121:'RXZXFFC2HZ',3110122:'RXZXFFC2HZ',3110123:'RXZXFFC2HZ',3110124:'RXZXFFC2HZ',3110125:'RXZXFFC2HZ',3110126:'RXZXFFC2HZ',3110127:'RXZXFFC2HZ',3110128:'RXZXFFC2HZ',3110129:'RXZXFFC2HZ',3110130:'RXZXFFC2HZ',
            //任选二-组选和值
            3110221:'RXZUFFC2HZ',3110222:'RXZUFFC2HZ',3110223:'RXZUFFC2HZ',3110224:'RXZUFFC2HZ',3110225:'RXZUFFC2HZ',3110226:'RXZUFFC2HZ',3110227:'RXZUFFC2HZ',3110228:'RXZUFFC2HZ',3110229:'RXZUFFC2HZ',3110230:'RXZUFFC2HZ',
            //任选三直选复式
            3110301 : 'RXZXFFC3',3110302 : 'RXZXFFC3',3110303 : 'RXZXFFC3',3110304 : 'RXZXFFC3',3110305 : 'RXZXFFC3',3110306 : 'RXZXFFC3',3110307 : 'RXZXFFC3',3110308 : 'RXZXFFC3',3110309 : 'RXZXFFC3',3110310 : 'RXZXFFC3',
            //任选三直选单式
            3110311 : 'RXZXFFC3DS',3110312 : 'RXZXFFC3DS',3110313 : 'RXZXFFC3DS',3110314 : 'RXZXFFC3DS',3110315 : 'RXZXFFC3DS',3110316 : 'RXZXFFC3DS',3110317 : 'RXZXFFC3DS',3110318 : 'RXZXFFC3DS',3110319 : 'RXZXFFC3DS',3110320 : 'RXZXFFC3DS',
            //任选三直选和值
            3110321 : 'RXZXFFC3HZ',3110322 : 'RXZXFFC3HZ',3110323 : 'RXZXFFC3HZ',3110324 : 'RXZXFFC3HZ',3110325 : 'RXZXFFC3HZ',3110326 : 'RXZXFFC3HZ',3110327 : 'RXZXFFC3HZ',3110328 : 'RXZXFFC3HZ',3110329 : 'RXZXFFC3HZ',3110330 : 'RXZXFFC3HZ',
            //任选三组选三
            3110401 : 'RXZUSANFFC3',3110402 : 'RXZUSANFFC3',3110403 : 'RXZUSANFFC3',3110404 : 'RXZUSANFFC3',3110405 : 'RXZUSANFFC3',3110406 : 'RXZUSANFFC3',3110407 : 'RXZUSANFFC3',3110408 : 'RXZUSANFFC3',3110409 : 'RXZUSANFFC3',3110410 : 'RXZUSANFFC3',
            //任选三组选六
            3110411 : 'RXZUSIXFFC3',3110412 : 'RXZUSIXFFC3',3110413 : 'RXZUSIXFFC3',3110414 : 'RXZUSIXFFC3',3110415 : 'RXZUSIXFFC3',3110416 : 'RXZUSIXFFC3',3110417 : 'RXZUSIXFFC3',3110418 : 'RXZUSIXFFC3',3110419 : 'RXZUSIXFFC3',3110420 : 'RXZUSIXFFC3',
            //任选三混合组选
            3110421 : 'RXZUFFC3HH',3110422 : 'RXZUFFC3HH',3110423 : 'RXZUFFC3HH',3110424 : 'RXZUFFC3HH',3110425 : 'RXZUFFC3HH',3110426 : 'RXZUFFC3HH',3110427 : 'RXZUFFC3HH',3110428 : 'RXZUFFC3HH',3110429 : 'RXZUFFC3HH',3110430 : 'RXZUFFC3HH',
            //任选三组选和值
            3110431 : 'RXZUFFC3HZ',3110432 : 'RXZUFFC3HZ',3110433 : 'RXZUFFC3HZ',3110434 : 'RXZUFFC3HZ',3110435 : 'RXZUFFC3HZ',3110436 : 'RXZUFFC3HZ',3110437 : 'RXZUFFC3HZ',3110438 : 'RXZUFFC3HZ',3110439 : 'RXZUFFC3HZ',3110440 : 'RXZUFFC3HZ',
            //任选四直选复式
            3110501 : 'RXZXFFC4',3110502 : 'RXZXFFC4',3110503 : 'RXZXFFC4',3110504 : 'RXZXFFC4',3110505 : 'RXZXFFC4',
            //任选四直选单式
            3110506 : 'RXZXFFC4DS',3110507 : 'RXZXFFC4DS',3110508 : 'RXZXFFC4DS',3110509 : 'RXZXFFC4DS',3110510 : 'RXZXFFC4DS',
            //任选四组选24
            3110601 : 'RXZU24FFC4',3110602 : 'RXZU24FFC4',3110603 : 'RXZU24FFC4',3110604 : 'RXZU24FFC4',3110605 : 'RXZU24FFC4',
            //任选四组选12
            3110606 : 'RXZU12FFC4',3110607 : 'RXZU12FFC4',3110608 : 'RXZU12FFC4',3110609 : 'RXZU12FFC4',3110610 : 'RXZU12FFC4',
            //任选四组选6
            3110611 : 'RXZU6FFC4',3110612 : 'RXZU6FFC4',3110613 : 'RXZU6FFC4',3110614 : 'RXZU6FFC4',3110615 : 'RXZU6FFC4',
            //任选四组选4
            3110616 : 'RXZU4FFC4',3110617 : 'RXZU4FFC4',3110618 : 'RXZU4FFC4',3110619 : 'RXZU4FFC4',3110620 : 'RXZU4FFC4',
            
            //pk拾
            //猜前二
            3110628:'PK10ZX2',3110629:'PK10ZX2',3110630:'PK10ZX3',3110631:'PK10ZX3',3110637:'PK10DWD',3110638:'PK10DWD',3110639:'PK10DWD',3110640:'PK10DWD',3110641:'PK10DWD',3110642:'PK10DWD',3110643:'PK10DWD',3110644:'PK10DWD',
            3110645:'PK10DWD',3110646:'PK10DWD',3110634:'PK10DXDS',3110635:'PK10DXDS',3110636:'PK10DXDS',
           //pk拾三期新增玩法
            3110650:'PK10ZX4',3110652:'PK10ZX5',3110653:'PK10GJLH',3110654:'PK10YJLH',3110655:'PK10JJLH',3110656:'PK10DSMLH',3110657:'PK10DWMLH',3110658:'PK10HZ2',
          //pk拾四期新增玩法
        	3110660:'PK10ZX6',3110661:'PK10HZ2',3110662:'PK10HZ2',3110664:'PK10HZ3',3110665:'PK10HZ3',3110667:'PK10JS',
        	
            //急速赛马
            3110728:'PK10ZX2',3110729:'PK10ZX2',3110730:'PK10ZX3',3110731:'PK10ZX3',3110737:'PK10DWD',3110738:'PK10DWD',3110739:'PK10DWD',3110740:'PK10DWD',3110741:'PK10DWD',3110742:'PK10DWD',3110743:'PK10DWD',3110744:'PK10DWD',
            3110745:'PK10DWD',3110746:'PK10DWD',3110734:'PK10DXDS',3110735:'PK10DXDS',3110736:'PK10DXDS',
            3110750:'PK10ZX4',3110752:'PK10ZX5',3110753:'PK10GJLH',3110754:'PK10YJLH',3110755:'PK10JJLH',3110756:'PK10DSMLH',3110757:'PK10DWMLH',3110758:'PK10HZ2',
        	3110760:'PK10ZX6',3110761:'PK10HZ2',3110762:'PK10HZ2',3110764:'PK10HZ3',3110765:'PK10HZ3',3110767:'PK10JS',
            
		},
            lt_issues : opts.issues,//所有的可追号期的初始集合
            lt_ajaxurl: opts.ajaxurl,
            lt_lottid : opts.lotteryid,
            lt_total_nums : 0,//总投注注数
            lt_total_money: 0,//总投注金额[非追号]
            lt_time_leave : 0, //本期剩余时间
            lt_same_code  : [],//用于限制一个方法里不能投相同单
            lt_ontimeout  : opts.ontimeout,
            lt_onfinishbuy: opts.onfinishbuy,
            lt_trace_base : 0,//追号的基本金额.
            lt_submiting  : false,//是否正在提交表单
            lt_prizes   : [] //投注内容的奖金情况
        });
        ps = null;
        opts.data_id = null;
        opts.issues  = null;
        opts.ajaxurl = null;
        opts.lotteryid = null;
        if( $.browser.msie ){//&& /MSIE 6.0/.test(navigator.userAgent)
            CollectGarbage();//释放内存
        }
        //开始倒计时
        $($.lt_id_data.id_count_down).lt_timer(opts.servertime,opts.cur_issue.endtime);
		
        //装载模式选择
        //$('<select name="lt_project_modes" id="lt_project_modes"></select>').appendTo($.lt_id_data.id_sel_modes);//此为装载玩sean
		
		//标识客户端投注来源
		if(getCookie('isclient') == 1){
			$("#play_source").val(4);
		}
        
		var bhtml = ''; //大标签HTML
        var hasdefault = false;//初始没有设置默认标签
        $.each(opts.data_label, function(i,n){//生成标签
            if(typeof(n)=='object'){
				//如果是后台设置的默认标签
				if(n.isdefault==1){
					//如果是新玩法
					hasdefault = true;
					//如果是新玩法
					if(n.isnew==1){
						bhtml += '<li class="hover">'+n.title+'<em></em></li>'
					}else{
						bhtml += '<li class="hover">'+n.title+'</li>'
					}
					//生成该标签下的小标签
					lt_smalllabel({title:n.title,label:n.label});
				}else{//如果不是后台设置的默认标签
					if(n.isnew==1){
						bhtml += '<li>'+n.title+'<em></em></li>'
					}else{
						bhtml += '<li>'+n.title+'</li>'
					}
					//如果后台没有设置默认标签,注意此时是不会形成某个玩法高亮的,所以后台必须设置一个默认玩法
					if(i==0){
						//生成该标签下的小标签
						lt_smalllabel({title:n.title,label:n.label});
					}
				}
            }
        });

		if($.lt_lottid == 1)
        { 
            $($.lt_id_data.id_changetype).show();
        } 
        $(bhtml).appendTo($.lt_id_data.id_labelbox);
        
        //如果没有设置默认玩法，将第一个设置为默认玩法
        if(hasdefault == false){
            $($.lt_id_data.id_labelbox + " li").eq(0).removeClass().addClass("hover");
        }
		//*
		//下面是对【小标签】进行切换（例如：前三、后三、二码）
        $($.lt_id_data.id_labelbox + " li").click(function(){//切换标签
			//获取当前点击标签的索引
			var index = $($.lt_id_data.id_labelbox + " li").index($(this));
			//如果当前标签是被选中的标签
			if($(this).hasClass("hover")){
				return false;
			}else{
				//清除被选中状态
				$($.lt_id_data.id_labelbox + " li").removeClass("hover");
				//标记选中状态
				$($.lt_id_data.id_labelbox + " li").eq(index).addClass("hover");
				//生成该标签下的小标签,如果有小标签
				if(opts.data_label[index].label.length>0){
					lt_smalllabel({title:opts.data_label[index].title,label:opts.data_label[index].label});
				}else{
					//即将推出敬请期待
					jjtc();
				}
			}
        });//*/
		
		
        //写入当前期
        $($.lt_id_data.id_cur_issue).html(opts.cur_issue.issue);
        $(".lottery_history_issue_pk10").find("span").html(opts.cur_issue.issue-1);
        if(sidebar_hover == "jssm"){
            var jssmIssue = opts.cur_issue.issue.split("-"),newIssue;
            jssmIssue[1] = jssmIssue[1]-1;
            newIssue = jssmIssue.join("-");
           $(".lottery_history_issue_pk10").find("span").html(newIssue); 
        }
        //写入当前期结束时间
        $($.lt_id_data.id_cur_end).html(opts.cur_issue.endtime);

		
        //生成并写入起始期内容
        var chtml = '<select name="lt_issue_start" id="lt_issue_start">';
        $.each($.lt_issues.today,function(i,n){
            chtml += '<option value="'+n.issue+'">'+n.issue+(n.issue==opts.cur_issue.issue?lot_lang.dec_s7:'')+'</option>';
        });
        var t = $.lt_issues.tomorrow.length-$.lt_issues.today.length;
        if( t > 0 ){//如果当天的期数小于每天的固定期数则继续增加显示
            for( i=0; i<t; i++ ){
                chtml += '<option value="'+$.lt_issues.tomorrow[i].issue+'">'+$.lt_issues.tomorrow[i].issue+'</option>';
            }
        }
        chtml += '</select><input type="hidden" name="lt_total_nums" id="lt_total_nums" value="0"><input type="hidden" name="lt_total_money" id="lt_total_money" value="0">';
        $(chtml).appendTo($.lt_id_data.id_issues);
		
		
        $($.lt_id_data.id_cf_clear).click(function(){//清空按钮
            $.confirm(lot_lang.am_s5,function(){
                $.lt_total_nums  = 0;//总注数清零
                $.lt_total_money = 0;//总金额清零
                $.lt_trace_base  = 0;//追号金额基数清零
                $.lt_same_code   = [];//已在确认区的数据
                $($.lt_id_data.id_cf_num).html(0);//显示数据清零
                $($.lt_id_data.id_cf_money).html(0);//显示数据清零
                $($.lt_id_data.id_cf_count).html(0);//总投注项清零
                $($.lt_id_data.id_cf_content + " tr.lottery").remove();
				//$($.lt_id_data.id_cf_content + " tr.cleanall").hide();
                cleanTraceIssue();//清空追号区数据
            });
        });
        //追号区
        $($.lt_id_data.id_tra_if).lt_trace({issues:opts.issues});

        //确认投注按钮事件
		$($.lt_id_data.id_sendok).lt_ajaxSubmit();


       //帮助中心
        $($.lt_id_data.id_methodhelp).hover(function(){
            if($($.lt_id_data.id_helpdiv).html().length > 2){
                var offset = $(this).position();
                var _top = +document.getElementById("lt_help").offsetTop + 15 +"px";
                var _left = document.getElementById("lt_help").offsetLeft;
                if($($.lt_id_data.id_helpdiv).html().length > 30){
                    $($.lt_id_data.id_helpdiv).css({"width":"300px"});
                }else{
                    $($.lt_id_data.id_helpdiv).css({"width":($.browser.msie ? "300px" : "auto")});
                }
                if(offset.left < $($.lt_id_data.id_helpdiv).width()){
                    //$($.lt_id_data.id_helpdiv).css({"left":(offset.left + 1)+"px","top":(offset.top + 14)+"px"}).show();
                    $($.lt_id_data.id_helpdiv).css({"top":_top,"left":_left});
                    $($.lt_id_data.id_helpdiv).show();
                }else{
                    //$($.lt_id_data.id_helpdiv).css({"left":(offset.left-$($.lt_id_data.id_helpdiv).width() + 64)+"px","top":(offset.top + 14)+"px"}).show();
                    $($.lt_id_data.id_helpdiv).css({"top":_top,"left":_left});
                    $($.lt_id_data.id_helpdiv).show();
                }
                //$($.lt_id_data.id_helpdiv).css({"left":(offset.left+$(this).width()+2)+"px","top":(offset.top-20)+"px"}).show();
            }
        },function(){
            $($.lt_id_data.id_helpdiv).hide();
        });

    }

    var lt_smalllabel = function(opts){//动态载入小标签
		//alert(opts);
        var ps = {title:'',label:[]};    //标签数据
        opts   = $.extend( {}, ps, opts || {} ); //根据参数初始化默认配置
		//alert(opts.title);
        var html = '';
        var modelhtml = '';
        function addItem(o, t, v){
            var i = new Option(t, v);
            o.options.add(i);
        }
        function SelectItem(obj,value){
            for(var i=0;i<obj.options.length;i++){
                if(obj.options[i].value == value){
                    obj.options[i].selected = true;
                    return true;
                }
            }
        }
        $.each(opts.label, function(i,n){
				html += '<dl class="cWay">' + 
							'<dt>'+n.gtitle+'</dt>';
				$.each(n.label, function(ii,nn){
					if(typeof(nn)=='object'){
						
						if( i == 0 && ii == 0){//第一个标签自动选择 新版杏彩sam
							html += '<dd class="hover" id="smalllabel_'+i+'_'+ii+'" name="smalllabel" v="'+i+'-'+ii+'">'+nn.desc+'</dd>';
							
							if( nn.methoddesc.length >0 ){
								$($.lt_id_data.id_methoddesc).html(nn.methoddesc).parent().show();
							}else{
								$($.lt_id_data.id_methoddesc).parent().hide();
							}
                                                        
							if( nn.methodexample && nn.methodexample.length > 0 ){
								$($.lt_id_data.id_methodexample).show();
								$($.lt_id_data.id_examplediv).html(nn.methodexample);
							}else{
								$($.lt_id_data.id_methodexample).hide();
								$($.lt_id_data.id_examplediv).html("");
							}                                                   
                                                        
							if( nn.methodhelp && nn.methodhelp.length > 0 ){
								$($.lt_id_data.id_helpdiv).html(nn.methodhelp);
							}else{
								$($.lt_id_data.id_helpdiv).html("");
							}                                                     

                            /* //机选功能运营说不用了
                            if ( nn.ifrandom && nn.ifrandom > 0 ) {
                                $($.lt_id_data.id_random_area).html('<input class="lt_random_bets_1 jx_button_90x26" title="机选1注" type="button" value="机选1注"  /><input class="lt_random_bets_5 jx_button_90x26" title="机选5注" type="button" value="机选5注"  /><input class="lt_random_bets_10 jx_button_90x26" title="机选10注" type="button" value="机选10注"  /><input type="hidden" id="randomcos" value="'+nn.randomcos+'" ><input type="hidden" id="randomcosvalue" value="'+nn.randomcosvalue+'">');
								$($.lt_id_data.id_random_area).show();
                            } else {
                                $($.lt_id_data.id_random_area).hide();
                            }
                            */                        
                                                        
							lt_selcountback();//选号区的统计归零
							$.lt_method_data = {
												methodid : nn.methodid,
												title: opts.title,
												name : nn.name,
												str  : nn.show_str,
                                                ifrandom  : nn.ifrandom,
                                                randomcos  : nn.randomcos,
                                                randomcosvalue  : nn.randomcosvalue,
												prize: nn.prize,
												nfdprize: nn.nfdprize,
												modes: $.lt_method_data.modes ? $.lt_method_data.modes : {},
												sp   : nn.code_sp,
												maxcodecount:nn.maxcodecount,
												defaultposition:nn.defaultposition,
                                                menuid : nn.menuid
											  };
							$($.lt_id_data.id_selector).lt_selectarea(nn.selectarea);//生成选号界面
                            $.gameBtn();//在较小屏幕下，变换投注按钮位置
                            filterHeight();//根据购彩区域高度来调整近期开奖和活动公告高度
                            
							//生成模式选择

							selmodes  = getCookie("modes");
							//*
							//SELECT框就会用到，单选框就没用到了。
							if(is_select)$("#lt_project_modes").empty();
							$.each(nn.modes,function(j,m){
								$.lt_method_data.modes[m.modeid]= {name:m.name,rate:Number(m.rate)};
								if(is_select)addItem($("#lt_project_modes")[0],''+m.name+'',m.modeid);
							});
							if(is_select)SelectItem($("#lt_project_modes")[0],selmodes);
							
							if((typeof(nn.nfdprize) != "undefined") && (nn.nfdprize.levs != "") && (typeof(nn.nfdprize.levs) != "undefined")){
							 $nfdhtml = '单注奖金：<select name="pmode" id="pmode">';
							 $nfdhtml += '<option value ="1" >奖金'+nn.nfdprize.defaultprize+"-"+nn.nfdprize.userdiffpoint+'%</option>';
							 $nfdhtml += '<option value ="2" selected="selected" >奖金'+nn.nfdprize.levs+'-0%</option>';
							 $("#nfdprize").html($nfdhtml);
								//2013-04-12 Tomcat 添加绑定记录用户返金模式功能,自动选择已选过的模式。
								var pmode_value = getCookie("pmode_selected_value");
								if(pmode_value)
								{
									$("#pmode").val(pmode_value);
								} else {
									$("#pmode").val("2");
									setCookie("pmode_selected_value",2);
								}
								$("#pmode").change( function(){
									setCookie("pmode_selected_value",$(this).val());
								});
								//2013-04-12 Tomcat ENd ------------------------------------------------
							}else{
								$("#wrapshow").css("display",'none');
								$("#nfdprize").html("");
							}
							//*/
						}else{//第一个标签不自动选择结束
							html += '<dd id="smalllabel_'+i+'_'+ii+'" name="smalllabel" v="'+i+'-'+ii+'">'+nn.desc+'</dd>';

						}//第一个标签自动选择结束sam
					}//if(typeof(nn)=='object'){ 结束
				});
				html += '</dl>';
        });
		
		
        $($.lt_id_data.id_smalllabel + " dl.cWay").remove();
		$($.lt_id_data.id_smalllabel).prepend(html);
        filterHeight();//根据购彩区域高度来调整近期开奖和活动公告高度

        $("dd[name='smalllabel']").click(function(){
			
			$("dd[name='smalllabel']").removeClass("hover");
			$(this).addClass("hover");
            var index = $(this).attr("v").split('-');
			
            if( opts.label[index[0]].label[index[1]].methoddesc.length >0 ){
                $($.lt_id_data.id_methoddesc).html(opts.label[index[0]].label[index[1]].methoddesc).parent().show();
            }else{
                $($.lt_id_data.id_methoddesc).parent().hide();
            }
            if( opts.label[index[0]].label[index[1]].methodhelp && opts.label[index[0]].label[index[1]].methodhelp.length>0 ){
                $($.lt_id_data.id_helpdiv).html(opts.label[index[0]].label[index[1]].methodhelp);
            }else{
				$($.lt_id_data.id_helpdiv).html("");
            }
            
            if( opts.label[index[0]].label[index[1]].methodexample && opts.label[index[0]].label[index[1]].methodexample.length>0 ){
 				$($.lt_id_data.id_methodexample).show();
				$($.lt_id_data.id_examplediv).html(opts.label[index[0]].label[index[1]].methodexample);
            }else{
				$($.lt_id_data.id_methodexample).hide();
				$($.lt_id_data.id_examplediv).html("");
            }

            /* //机选功能运营说不用了          
            if( opts.label[index[0]].label[index[1]].ifrandom && opts.label[index[0]].label[index[1]].ifrandom>0 ){
                $($.lt_id_data.id_random_area).html('<input class="lt_random_bets_1 jx_button_90x26" title="机选1注" type="button" value="机选1注"  /><input class="lt_random_bets_5 jx_button_90x26" title="机选5注" type="button" value="机选5注"  /><input class="lt_random_bets_10 jx_button_90x26" title="机选10注" type="button" value="机选10注"  /><input type="hidden" id="randomcos" value="'+opts.label[index[0]].label[index[1]].randomcos+'" ><input type="hidden" id="randomcosvalue" value="'+opts.label[index[0]].label[index[1]].randomcosvalue+'">');
				$($.lt_id_data.id_random_area).show();
            } else {
                $($.lt_id_data.id_random_area).hide();
            }
            */    

            lt_selcountback();//选号区的统计归零
            $.lt_method_data = {
                                methodid : opts.label[index[0]].label[index[1]].methodid,
                                title: opts.title,
                                name : opts.label[index[0]].label[index[1]].name,
                                ifrandom  : opts.label[index[0]].label[index[1]].ifrandom,
                                randomcos  : opts.label[index[0]].label[index[1]].randomcos,
                                randomcos  : opts.label[index[0]].label[index[1]].randomcosvalue,
                                str  : opts.label[index[0]].label[index[1]].show_str,
                                prize: opts.label[index[0]].label[index[1]].prize,
								nfdprize: opts.label[index[0]].label[index[1]].nfdprize,
                                modes: $.lt_method_data.modes ? $.lt_method_data.modes : {},
                                sp   : opts.label[index[0]].label[index[1]].code_sp,
                                maxcodecount:opts.label[index[0]].label[index[1]].maxcodecount,
								defaultposition:opts.label[index[0]].label[index[1]].defaultposition,
                                menuid : opts.label[index[0]].label[index[1]].menuid
                              };
			
			//单注奖金：<select name="" id=""><option value="1">1950-0%</option></select>
			if(typeof(opts.label[index[0]].label[index[1]].nfdprize.defaultprize) != 'undefined' && opts.label[index[0]].label[index[1]].nfdprize.levs != '' ){
			 $nfdhtml = '单注奖金：<select name="pmode" id="pmode">';
			 $nfdhtml += '<option value ="1" >奖金'+opts.label[index[0]].label[index[1]].nfdprize.defaultprize
					  +"-"+opts.label[index[0]].label[index[1]].nfdprize.userdiffpoint+'%</option>';
			 $nfdhtml += '<option value ="2" selected="selected" >奖金'+opts.label[index[0]].label[index[1]].nfdprize.levs+'-0%</option>';
			 $("#nfdprize").html($nfdhtml);
			 
                //2013-04-12 Tomcat 添加绑定记录用户返金模式功能,自动选择已选过的模式。
                var pmode_value = getCookie("pmode_selected_value");
                if(pmode_value != null){
                    $("#pmode").val(pmode_value);
                }
                $("#pmode").change( function(){
                    setCookie("pmode_selected_value",$(this).val());
                });
                //2013-04-12 Tomcat end-----------------------------------------------
			}
			else{
				 $("#wrapshow").css("display",'none');
				 $("#nfdprize").html("");
			}
            $($.lt_id_data.id_selector).lt_selectarea(opts.label[index[0]].label[index[1]].selectarea);//生成选号界面
            $.gameBtn();//在较小屏幕下，变换投注按钮位置
            filterHeight();//根据购彩区域高度来调整近期开奖和活动公告高度
            
            //生成模式选择
            //modelhtml = '<select name="lt_project_modes" id="lt_project_modes">';
            //modelhtml = '';
            $("#lt_project_modes").empty();
            //$("#lt_project_modes")[0].options.length ==0;
            selmodes  = getCookie("modes");
            $.each(opts.label[index[0]].label[index[1]].modes,function(j,m){
                $.lt_method_data.modes[m.modeid]= {name:m.name,rate:Number(m.rate)};
                //modelhtml += '<option value="'+m.modeid+'" '+(selmodes==m.modeid ? 'selected="selected"' : '')+' >&nbsp;&nbsp;'+m.name+'&nbsp;&nbsp;</option>';
                if(is_select)addItem($("#lt_project_modes")[0],''+m.name+'',m.modeid);
            });
            if(is_select)SelectItem($("#lt_project_modes")[0],selmodes);
            //$("#lt_project_modes").empty();
            //$("#lt_project_modes")[0].options.length ==0;
            //$(modelhtml).appendTo("#lt_project_modes");
            /*modelhtml += '</select>';
            $($.lt_id_data.id_sel_modes).empty();
            $(modelhtml).appendTo($.lt_id_data.id_sel_modes);*/

        });
		
    };

    var lt_selcountback = function(){

        //$($.lt_id_data.id_sel_times).val(1);
        $($.lt_id_data.id_sel_money).html(0);
        $($.lt_id_data.id_sel_num).html(0);
    };
	
    //倒计时
    $.fn.lt_timer = function(start,end){//服务器开始时间，服务器结束时间
        var me = this;
        if( start == "" || end == "" ){
            $.lt_time_leave = 0;
        }else{
            $.lt_time_leave = (format(end).getTime()-format(start).getTime())/1000;//总秒数
        }
        function fftime(n){
            return Number(n)<10 ? ""+0+Number(n) : Number(n);
        }
        function format(dateStr){//格式化时间
            return new Date(dateStr.replace(/[\-\u4e00-\u9fa5]/g, "/"));
        }
        function diff(t){//根据时间差返回相隔时间
            return t>0 ? {
    			day : Math.floor(t/86400),
    			hour : Math.floor(t%86400/3600),
    			minute : Math.floor(t%3600/60),
    			second : Math.floor(t%60)
    		} : {day:0,hour:0,minute:0,second:0};
        }
        var timerno = window.setInterval(function(){
            if($.lt_time_leave > 0 && ($.lt_time_leave % 240 == 0 || $.lt_time_leave == 60 )){//每隔4分钟以及最后一分钟重新读取服务器时间
                $.ajax({
                        type: 'POST',
                        URL : $.lt_ajaxurl,
                        timeout : 30000,
                        data: "lotteryid="+$.lt_lottid+"&issue="+$($.lt_id_data.id_cur_issue).html()+"&flag=gettime",
                        success : function(data){//成功
                            data = parseInt(data,10);
                            data = isNaN(data) ? 0 : data;
                            data = data <= 0 ? 0 : data;
                            $.lt_time_leave = data;
                        }
                });
            }

            if( $.lt_time_leave <= 0 ){//结束
                clearInterval(timerno);
                if( $.lt_submiting == false ){//如果没有正在提交数据则弹出对话框,否则主动权交给提交表单
                    $.unblockUI({fadeInTime: 0, fadeOutTime: 0});
					if($($.lt_id_data.id_cur_issue).html()>''){
						$.alert(lot_lang.am_s15);
						//传说中的5秒自动关闭
                        if(sidebar_hover == "cq_ffc" || sidebar_hover == "hnquick5" || sidebar_hover == "pk10" || sidebar_hover == "jssm"){
                            $("#alert_close_button").val("(5) 确定");                //
                            var second = 4;
                            var timer5;                
                            timer5 = window.setTimeout(timeFun5,1000);
                            
                            function timeFun5(){
                                $("#alert_close_button").val("(" + second + ") 确定");
                                second--;
                                if(second < 0){
                                    if($("#JS_blockOverlay").length == 1 && $("#JS_blockPage").length == 1){
                                        $("#JS_blockOverlay").remove();
                                        $("#JS_blockPage").remove();
                                    }
                                    clearTimeout(timer5);
                                }else{
                                    timer5 = window.setTimeout(timeFun5,1000);
                                }
                            }
                        }
                        //传说中的5秒自动关闭
                        $.lt_reset(true);
                        $.lt_ontimeout(); 

					/*	$.confirm(lot_lang.am_s15,function(){//确定
							$.lt_reset(false);
							$.lt_ontimeout();
						},function(){//取消
							$.lt_reset(true);
							$.lt_ontimeout();
						});*/
					}else{
						/*if($.lt_lottid == '4'){
						$.alert('该彩种已经停止销售！敬请留意网站公告！');
						return false;
						}else{*/
						$.alert(lot_lang.am_s15_2);
						//}
					}
                }
            }
            var oDate = diff($.lt_time_leave--);
            $(me).html(""+(oDate.day>0 ? oDate.day+(lot_lang.dec_s21)+" " : "")+"<div class=\"hour\">"+fftime(oDate.hour)+":</div><div class=\"min\">"+fftime(oDate.minute)+":</div><div class=\"sec\">"+fftime(oDate.second)+"</div>");
        },1000);
    };
	//根据投单完成和本期销售时间结束，进行重新更新整个投注界面
/*
	$.finishdofunc = function(){


		 $.ajax({
                        type: 'POST',
                        URL : $.lt_ajaxurl,
                        timeout : 30000,
                        data: "lotteryid="+$.lt_lottid+"&issue="+$($.lt_id_data.id_cur_issue).html()+"&flag=getlatest",
                        success : function(data){//成功
						//	var tmpdatas =	eval(data);
								eval("data="+data);
					//			$('#availabalances').html(data.availablebalance);

                        }
                });
	}*/
	$.lt_reset = function(iskeep){
	    if( iskeep && iskeep === true ){
            iskeep = true;
        }else{
            iskeep = false;
        }
        if( $.lt_time_leave <= 0 ){//本期结束后的刷新
            //01:刷新选号区
            if( iskeep == false ){
                $(":radio:checked",$($.lt_id_data.id_smalllabel)).removeData("ischecked").click();
            }
            //02:刷新确认区
            if( iskeep == false ){
                $.lt_total_nums  = 0;//总注数清零
                $.lt_total_money = 0;//总金额清零
                $.lt_trace_base  = 0;//追号基础数据
                $.lt_same_code   = [];//已在确认区的数据
                $($.lt_id_data.id_cf_num).html(0);//显示数据清零
                $($.lt_id_data.id_cf_money).html(0);//显示数据清零
                $($.lt_id_data.id_cf_content + " tr.lottery").remove();
				//$($.lt_id_data.id_cf_content + " tr.cleanall").hide();
                $($.lt_id_data.id_cf_count).html(0);
                $("#times").attr('selected');
            }
            //读取新数据刷新必须刷新的内容
            $.ajax({

                type: 'POST',
                URL : $.lt_ajaxurl,
                data: "lotteryid="+$.lt_lottid+"&flag=read",
                success : function(data){//成功

                                if( data.length <= 0 ){
                                    $.alert(lot_lang.am_s16);
                                    return false;
                                }
                                var partn = /<script.*>.*<\/script>/;
                                if( partn.test(data) ){
                                    alert(lot_lang.am_s17);
        							top.location.href="../?controller=default";
        							return false;
                                }
                                if( data == "empty" ){
									//未到销售时间
									//$.alert(lot_lang.am_s15_2);
                                    $.alert(lot_lang.am_s18);
                                    //window.location.href="./?controller=default&action=start";
                                    return false;
                                }
                                eval("data="+data);
                                //03:刷新当前期的信息
                                $($.lt_id_data.id_cur_issue).html(data.issue);
                                if(sidebar_hover == "pk10"){
                                    setTimeout(function(){
                                        $(".lottery_history_issue_pk10").find("span").html(data.issue-1);
                                            var sparkTimes=0;
                                            (function mv(){
                                                sparkTimes++;
                                                $(".lottery_history_issue_pk10").find("span").velocity({"opacity":0},300,function(){
                                                    $(this).velocity("reverse",function(){
                                                        if(sparkTimes<5)mv();
                                                    });
                                                });
                                        })();
                                    },30000);
                                }      
                                if(sidebar_hover == "jssm"){
                                    var jssmIssue = data.issue.split("-"),newIssue;
                                    jssmIssue[1] = jssmIssue[1]-1;
                                    newIssue = jssmIssue.join("-");
                                    setTimeout(function(){
                                        $(".lottery_history_issue_pk10").find("span").html(newIssue);
                                            var sparkTimes=0;
                                            (function mv(){
                                                sparkTimes++;
                                                $(".lottery_history_issue_pk10").find("span").velocity({"opacity":0},300,function(){
                                                    $(this).velocity("reverse",function(){
                                                        if(sparkTimes<5)mv();
                                                    });
                                                });
                                        })();
                                    },10000);
                                }          
                                $($.lt_id_data.id_cur_end).html(data.saleend);
                                //04:重新开始计时
                                $($.lt_id_data.id_count_down).lt_timer(data.nowtime, data.saleend);
                                var l = $.lt_issues.today.length;
                                //05:更新起始期
                                while(true){
                                    if( data.issue == $.lt_issues.today.shift().issue ){
                                        break;
                                    } else {
                                        break;
                                    }
                                }
                                $.lt_issues.today.unshift({issue:data.issue,endtime:data.saleend});
                                //重新生成并写入起始期内容
                                //var chtml = '<select name="lt_issue_start" id="lt_issue_start">';
                                var chtml = '';
                                $.each($.lt_issues.today,function(i,n){
                                    chtml += '<option value="'+n.issue+'">'+n.issue+(n.issue==data.issue?lot_lang.dec_s7:'')+'</option>';
                                });
                                var t = $.lt_issues.tomorrow.length-$.lt_issues.today.length;
                                if( t > 0 ){//如果当天的期数小于每天的固定期数则继续增加显示
                                    for( i=0; i<t; i++ ){
                                        chtml += '<option value="'+$.lt_issues.tomorrow[i].issue+'">'+$.lt_issues.tomorrow[i].issue+'</option>';
                                    }
                                }
                                /*chtml += '</select>';
                                $("#lt_issue_start").remove();
                                $(chtml).appendTo($.lt_id_data.id_issues);*/
                                $("#lt_issue_start").empty();
                                $(chtml).appendTo("#lt_issue_start");
                                //06:更新可追号期数
                                t_count = $.lt_issues.tomorrow.length;
                                $($.lt_id_data.id_tra_alct).html(t_count);
                                //07:更新追号数据
                                cleanTraceIssue();//清空追号区数据
                                while(true){//删除追号列表里已经过期的数据
                                    $j = $("tr[id^='tr_trace_']:first",$("#lt_trace_issues_today"));
                                    if($j.length <= 0){
                                        break;
                                    }
                                    if( $j.find(":checkbox").val() == data.issue ){
                                        break;
                                    }
                                    $j.remove();
                                }
                          },
                error : function(){//失败
                    $.alert(lot_lang.am_s16);
                    cleanTraceIssue();//清空追号区数据
                    return false;
                }
            });
        }else{//提交表单成功后的刷新
            //01:刷新选号区
            if( iskeep == false ){
                $(":radio:checked",$($.lt_id_data.id_smalllabel)).removeData("ischecked").click();
            }
            //02:刷新确认区
            if( iskeep == false ){
                $.lt_total_nums  = 0;//总注数清零
                $.lt_total_money = 0;//总金额清零
                $.lt_trace_base  = 0;//追号基数
                $.lt_same_code   = [];//已在确认区的数据
                $($.lt_id_data.id_cf_num).html(0);//显示数据清零
                $($.lt_id_data.id_cf_money).html(0);//显示数据清零
                $($.lt_id_data.id_cf_content + " tr.lottery").remove();
				//$($.lt_id_data.id_cf_content + " tr.cleanall").hide();
                $($.lt_id_data.id_cf_count).html(0);
            }
            //03:刷新追号区
            if( iskeep == false ){
                cleanTraceIssue();//清空追号区数据
            }
        }
        $.gameBtn();
	};
	//提交表单
	var ajaxSubmitAllow = true;
	$.fn.lt_ajaxSubmit = function(){
	    var me = this;

	    $(this).click(function(){

            if($(this).hasClass('sendBtnDisabled')){//没有选注不让操作
                return false;
            }
			/*if($.lt_lottid == '4'){
			$.alert('该彩种已经停止销售！敬请留意网站公告！');
			return;
			}*/
	        if( checkTimeOut() == false ){
	            return;
	        }
	        $.lt_submiting = true;//倒计时提示的主动权转移到这里
	        //var istrace = $($.lt_id_data.id_tra_if).hasClass("clicked");//是否追号
			var istrace = $($.lt_id_data.id_tra_ifb).prop("checked")==true ? 1 : 0;//是否追号
			//alert(istrace);
            if( $.lt_total_nums <= 0 || $.lt_total_money <= 0 ){//检查是否有投注内容
                $.lt_submiting = false;
                $.alert(lot_lang.am_s6);
                return;
            }
            if( istrace == true ){
	            if( $.lt_trace_issue <= 0 || $.lt_trace_money <= 0 ){//检查是否有追号内容
	                $.lt_submiting = false;
	                $.alert(lot_lang.am_s20);
                    return;
	            }
	            var terr = "";
	            $("input[name^='lt_trace_issues']:checked",$($.lt_id_data.id_tra_issues)).each(function(){
	                if( Number($(this).closest("tr").find("input[name^='lt_trace_times_']").val()) <= 0 ){
	                    terr += $(this).val()+'\n';
	                }
	            });
	            if( terr.length > 0 ){//有错误倍数的奖期
	                $.lt_submiting = false;
	                $.alert(lot_lang.am_s21.replace("[errorIssue]",terr));
                    return;
	            }
	        }
            if( istrace == true ){
                var msg = lot_lang.am_s14.replace("[count]",$.lt_trace_issue);
            }else{
                var msg = lot_lang.dec_s8.replace("[issue]",$("#lt_issue_start").val());
            }
            msg += '<div class="floatarea">';
            var modesmsg = [];
            var modes=0;
            $.each($('tr.lottery',$($.lt_id_data.id_cf_content)),function(i,n){
                modes = $(n).data('data').modes;
                if( modesmsg[modes] == undefined ){
                    modesmsg[modes] = [];
                }
                $("th",n).find(".more").css("display","none");
                modesmsg[modes].push($("th",n).html().replace(lot_lang.dec_s5,""));
            });
            $.each(modesmsg,function(i,n){
                if( $.lt_method_data.modes[i] != undefined && n != undefined && n.length>0 ){
                    $.each(n,function(index,value){
                        msg += '<p><span>' +$.lt_method_data.modes[i].name+ '</span><b>' + value + '</b></p>';
                    })
                }
            });
            msg += '</div>';
            $.lt_trace_money = Math.round($.lt_trace_money*1000)/1000;
            msg += '<div class="totleNum"><span class="numlabel">' + lot_lang.dec_s9 + ':</span> <span>'+(istrace==true ? $.lt_trace_money : $.lt_total_money)+' '+lot_lang.dec_s3 + '</span></div>';
            msg=msg.replace("[关闭]","");
            $.confirm(msg,function(){//点确定[提交]

                if( checkTimeOut() == false ){//正式提交前再检查1下时间
                    $.lt_submiting = false;
    	            return;
    	        }

    	        $("#lt_total_nums").val($.lt_total_nums);
    	        $("#lt_total_money").val($.lt_total_money);
				
				//解决瞬间提交2次的问题
				if(ajaxSubmitAllow){
					ajaxSubmitAllow = false;
					ajaxSubmit();
				}
				
            },function(){//点取消
                $.lt_submiting = false;
                return checkTimeOut();
            },'',400);
        });
        //检查时间是否结束，然后做处理
        function checkTimeOut(){
            if( $.lt_time_leave <= 0 ){//结束
				if($($.lt_id_data.id_cur_issue).html()>''){
					$.confirm(lot_lang.am_s15,function(){//确定
						$.lt_reset(false);
						$.lt_ontimeout();
					},function(){//取消
						$.lt_reset(true);
						$.lt_ontimeout();
					});
				}else{
					$.alert(lot_lang.am_s15_2);
				}
                return false;
            }else{
                return true;
            }
        };
        
        $($.lt_id_data.id_methodexample).hover(function(){
            if($($.lt_id_data.id_examplediv).html().length > 2){
                var offset = $(this).position();
                //var _top = $(this).offset().top;
                //var _left = $(this).offset().left;
                var _top = +document.getElementById("lt_example").offsetTop + 15 +"px";
                var _left = document.getElementById("lt_example").offsetLeft;
                //console.log(_top,_left);
                if($($.lt_id_data.id_examplediv).html().length > 30){
                    $($.lt_id_data.id_examplediv).css({"width":"300px"});
                }else{
                    $($.lt_id_data.id_examplediv).css({"width":($.browser.msie ? "300px" : "auto")});
                }
                if(offset.left < $($.lt_id_data.id_examplediv).width()){
                    //$($.lt_id_data.id_examplediv).css({"left":(offset.left + 1)+"px","top":(offset.top + 14)+"px"}).show();
                    $($.lt_id_data.id_examplediv).css({"top":_top,"left":_left});
                    $($.lt_id_data.id_examplediv).show();
                }else{
                    //$($.lt_id_data.id_examplediv).css({"left":(offset.left-$($.lt_id_data.id_examplediv).width() + 100)+"px","top":(offset.top + 14)+"px"}).show();
                    $($.lt_id_data.id_examplediv).show();
                    $($.lt_id_data.id_examplediv).css({"top":_top,"left":_left});
                }
            }
        },function(){
            $($.lt_id_data.id_examplediv).hide();
        });    
     
        
        //ajax提交表单 sean
        function ajaxSubmit(){
            $.blockUI({
            message: lot_lang.am_s22,
            overlayCSS: {backgroundColor: '#000',opacity: 0.5,cursor:'wait'}
            });
            //var form = $(me).closest("form");
            var form = $(".lotteryBox").find("form[name='buyform']");
			var randomNum = Math.floor((Math.random() * 10000) + 1);

            $.ajax({
                type: 'POST',
                url : $.lt_ajaxurl,
                timeout : 600000,
                data: $(form).serialize() + "&randomNum=" + randomNum,
                success: function(data){
						//解决瞬间提交2次的问题
						ajaxSubmitAllow = true;
						
                        $.unblockUI({fadeInTime: 0, fadeOutTime: 0});
                        $.lt_submiting = false;
                        if( data.length <= 0 ){
                            $.alert(lot_lang.am_s16);
                            return false;
                        }
                        //console.log($(form).serialize());
                        var partn = /<script.*>.*<\/script>/;
                        if( partn.test(data) ){
                            alert(lot_lang.am_s17);
							top.location.href="../?controller=default";
							return false;
                        }
						if( data == "slowly" ){//网络缓慢
                            $.alert(lot_lang.am_s36,lot_lang.dec_s25,function(){
                                if( checkTimeOut() == true ){//时间未结束
                                    $.lt_reset();
                                }
                                $.lt_onfinishbuy();
								//$.finishdofunc();
								
								/*全清功能*/
								showClearAll();
                            });
                            return false;
                        }
                        if( data == "success" ){//购买成功
                            $.alert(lot_lang.am_s24,lot_lang.dec_s25,function(){
                                if( checkTimeOut() == true ){//时间未结束
                                    $.lt_reset();
                                }
                                $.lt_onfinishbuy();

                                //追号相关
                                $(".fqzhBox span").removeClass().addClass("uncheck");
                                $(".fqzhBox span").siblings("input[type='checkbox']").prop("checked",false);
                                $(".tzzhBox span").removeClass().addClass("uncheck");
                                $(".tzzhBox span").siblings("input[type='checkbox']").prop("checked",false);
                                
                                $($.lt_id_data.id_tra_ifb).val("no");
                                $("#lt_trace_assert").val("no");
                                
                                $.funList.tzjlfn();//获取投注记录
								//$.finishdofunc();
                            });
                            return false;
                        }else{//购买失败提示
                            eval("data = "+ data +";");
                            if( data.stats == 'error' ){//错误
                                $.alert(data.data,'',function(){
                                    return checkTimeOut();
                                });
                                return false;
                            }
                            if( data.stats == 'fail' ){//有失败的
                                msg  = lot_lang.am_s25.replace("[success]",data.data.success).replace("[fail]",data.data.fail);
                                msg += '<div class="floatarea">';
                                $.each(data.data.content,function(i,n){
                                    msg += n+"\n";
                                });
                                msg += '</div>';
                                msg += lot_lang.am_s26;
                                $.confirm(msg,function(){//点确定[清空]
                                    if( checkTimeOut() == true ){//时间未结束
                                        $.lt_reset();
                                    }
                                    $.lt_onfinishbuy();
                                },function(){//点取消
                                    return checkTimeOut();
                                    $.lt_onfinishbuy();
                                },'',400);
                            }
                        }
                },
                error: function(){
                        $.lt_submiting = false;
                        $.unblockUI({fadeInTime: 0, fadeOutTime: 0});
                        $.alert(lot_lang.am_s23,'',checkTimeOut);
                     }
            });
        };

	};

    $.gameBtn = function(){
        var id_sel_num = $($.lt_id_data.id_sel_num).html(),//添加投注 已选注数
            id_sel_insert = $($.lt_id_data.id_sel_insert),//添加投注 添加按钮
            id_cf_count = $($.lt_id_data.id_cf_count).html(),//立即投注 已选单
            id_sendok = $($.lt_id_data.id_sendok);//立即投注 立即按钮

            if(id_sel_num == 0){
                id_sel_insert.addClass('addBtnDisabled'); 
            }else{
                id_sel_insert.removeClass('addBtnDisabled'); 
            }

            if(id_cf_count == 0){
                id_sendok.addClass('sendBtnDisabled'); 
            }else{
                id_sendok.removeClass('sendBtnDisabled');   
            }
        //alert($.lt_id_data.id_examplediv)
    }

})(jQuery);
