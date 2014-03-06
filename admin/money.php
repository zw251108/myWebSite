<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<title></title>
	<link rel="stylesheet" href="../style/style.css"/>
	<style>
		h3{
			float: left;
			margin: 10px;
			padding: 10px;
			color: white;
		}
		.bc1{
			background: #7d4f9e;
		}
		.bc2{
			background: #30dff3;
		}
		.cmb{
			background: #b22c46;
		}
		.ccb{
			background: #d9d919;
		}
		.all{
			background: #1d1626;
		}
		.tooltip{
			position: absolute;
			min-height: 100px;
			width: 150px;

			border: 5px solid #c0c0c0;
			border-radius: 10px;
			padding: 10px;
			background: #fff;

			color: #000;
			line-height: 2em;
			text-align: left;
		}

		svg{
			clear:both;
			float: left;
			font-size: 10px;
		}
		path{
			fill: transparent;
		}
		.line{
			stroke-width: 1
		}
		g line{
			stroke:#c0c0c0;
			stroke-width:1;
		}
		.axis path,
		.axis line{
			fill: none;
			stroke: #000;
			shape-rendering: crispEdges;
		}
	</style>
</head>
<body>

<div>
	<h3 class="bc1">bc1</h3>
	<h3 class="bc2">bc2</h3>
	<h3 class="cmb">cmb</h3>
	<h3 class="ccb">ccb</h3>
	<h3 class="all">all</h3>
</div>

<div id="tooltip" class="tooltip hidden">
	类型：<span id="bank"></span>
	<br />
	余额：￥ <span id="num"></span>
	<br />
	时间：<span id="date"></span>
</div>

<script src="../script/lib/jQuery/jquery-1.10.2.min.js"></script>
<script src="../script/lib/d3/d3.v3.min.js"></script>
<script>
var data = [
		{date: new Date('2012/12/31'),	bc1: 9455,	bc2: 0,		cmb: 12190,	ccb: 2914,	all: 24559},
		{date: new Date('2013/02/14'),	bc1: 8955,	bc2: 0,		cmb: 11765,	ccb: 8314,	all: 29034},
		{date: new Date('2013/07/21'),	bc1: 13573,	bc2: 5440,	cmb: 12164,	ccb: 8327,	all: 39504},
		{date: new Date('2013/08/11'),	bc1: 13564, bc2: 5440, 	cmb: 11900, ccb: 7327, 	all: 38231},
		{date: new Date('2013/08/25'),	bc1: 13564, bc2: 8914, 	cmb: 11900, ccb: 7327, 	all: 41705},
		{date: new Date('2013/09/01'),	bc1: 13564, bc2: 4710, 	cmb: 11900, ccb: 7327, 	all: 37501},
		{date: new Date('2013/09/15'),	bc1: 13564, bc2: 8683, 	cmb: 11633, ccb: 7327, 	all: 41207},
		{date: new Date('2013/09/29'),	bc1: 13064, bc2: 504,  	cmb: 11633, ccb: 7327, 	all: 32528},
		{date: new Date('2013/10/13'),	bc1: 12576, bc2: 5083, 	cmb: 10837, ccb: 11824, all: 40320},
		{date: new Date('2013/11/03'),	bc1: 12576, bc2: 3583, 	cmb: 10626, ccb: 11824, all: 38609},
		{date: new Date('2013/11/14'),	bc1: 12576, bc2: 7697, 	cmb: 10336, ccb: 11824, all: 42433},
		{date: new Date('2013/11/17'),	bc1: 12576, bc2: 6697, 	cmb: 10339, ccb: 11824, all: 41436},
		{date: new Date('2013/11/21'),	bc1: 12576, bc2: 2493, 	cmb: 10339, ccb: 11824, all: 37232},
		{date: new Date('2013/12/04'),	bc1: 12576, bc2: 993,  	cmb: 10831, ccb: 11824, all: 36224},
		{date: new Date('2013/12/15'),	bc1: 12576, bc2: 3787, 	cmb: 11831, ccb: 11824, all: 40018},
		{date: new Date('2013/12/22'),	bc1: 12587, bc2: 3290, 	cmb: 11701, ccb: 11834, all: 39412},
		{date: new Date('2013/12/29'),	bc1: 12587, bc2: 2790, 	cmb: 11702, ccb: 11834, all: 38913},
		{date: new Date('2014/01/05'),	bc1: 12587, bc2: 1790, 	cmb: 11702, ccb: 11834, all: 37913},
		{date: new Date('2014/01/19'),	bc1: 12587, bc2: 6263, 	cmb: 11419, ccb: 11334, all: 41603},
		{date: new Date('2014/01/24'),  bc1: 12587, bc2: 10243, cmb: 10772, ccb: 11334, all: 44936},
		{date: new Date('2014/02/16'),  bc1: 12587, bc2: 10243, cmb: 18772, ccb: 11334, all: 52936}
		, {date: new Date('2014/02/23'),  bc1: 12587, bc2: 6039, cmb: 18272, ccb: 11334, all: 48232}
        , {date: new Date('2014/03/02'), bc1: 1087, bc2: 39 , cmb: 11072, ccb: 1034, alipay: 34504, all: 47736}
	]
	, ali = [{
		date: new Date('2014/02/25')
        , base: 6000
		, m: 0.96
	}, {
		date: new Date('2014/02/26')
        , base: 6000
		, m: 0.96
	}, {
		date: new Date('2014/02/27')
        , base: 6000
		, m: 0.95
	}, {
		date: new Date('2014/02/28')
        , base: 6000
		, m: 0.94
    }, {
        date: new Date('2014/03/01')
        , base: 6000
        , m: 0.94
	}]
	;

$(function(){
	var width = 800,
		height = 400,
		margin = 100,
		fill = ['#7d4f9e', '#30dff3', '#b22c46', '#d9d919', '#f90', '#1d1626'],
        keys = ['bc1', 'bc2', 'cmb', 'ccb', 'alipay', 'all'],
        keyName = ['中行卡 1', '中行卡 2', '招行卡', '建行卡', '余额宝', '总资产'],


		x = d3.time.scale().range([0, width]),
		y = d3.scale.linear().range([height, 0]),

		xAxis = d3.svg.axis().scale(x).orient('bottom'),
		yAxis = d3.svg.axis().scale(y).orient('left'),

		svg = d3.select('body').append('svg').attr('width', width + margin *2).attr('height', height + margin)
			.append('g').attr('transform', 'translate(100,30)'),

		i = 0, j = data.length,
        m = 0, n = keys.length,

		toolTip = d3.select('#tooltip'),
		toolTip_bank = toolTip.select('#bank'),
		toolTip_date = toolTip.select('#date'),
		toolTip_num = toolTip.select('#num'),
		showToolTip = function(d, key){
			var self = d3.select(this).attr('stroke-width', 5),
				x = parseFloat( self.attr('cx') ) +100,
				y = parseFloat( self.attr('cy') ) +120,
				text = keyName[key],
				date = d.date,
				month = date.getMonth() +1,
				day = date.getDate();

//			switch( key ){
//				case 'all':
//					text = '总资产';
//					break;
//				case 'bc1':
//					text = '中行卡 1';
//					break;
//				case 'bc2':
//					text = '中行卡 2';
//					break;
//				case 'cmb':
//					text = '招行卡';
//					break;
//				case 'ccb':
//					text = '建行卡';
//					break;
//			}

			toolTip.style('left', x +'px').style('top', y +'px').classed('hidden', false);
			toolTip_bank.text( text );
			toolTip_num.text( d[keys[key]] || 0 );
			toolTip_date.text( date.getFullYear() +'-'+ (month > 9 ? month : '0'+ month)
				+'-'+ (day > 9 ? day : '0'+ day) );
		},
		hideToolTip = function(){
			d3.select(this).attr('stroke-width', 1);

			toolTip.classed('hidden', true);
        },
        line,
        point,
        datetime = {};

    x.domain([d3.min(data, function(d){
        return d.date;
    }) -3600*24*5*1000, d3.max(data, function(d){
        return d.date;
    })]);
    y.domain([0, d3.max(data, function(d){
        return d.all;
    }) +10000]);

    xAxis.tickFormat( d3.time.format('%Y-%m') );

    for(; m < n; m++){
        // 折线
        line = (function(k){
            return d3.svg.line().x(function(d){
                return x( d.date );
            }).y(function(d){
                return y( d[keys[k]] || 0 );
            });
        })(m);

        svg.append('path').attr('class', 'line').style('stroke', fill[m]).datum(data).attr('d', line);
    }

    point = svg.selectAll('.x').data( data ).enter().append('g').attr('class', 'x');
    point.filter(function(d){
        var date = d.date,
            y = date.getFullYear(),
            m = date.getMonth(),
            day = date.getDate(),
            rs;

        if( !(y in datetime) ){
            datetime[y] = {};
        }

        if( m in datetime[y] ){
            rs = false;
        }
        else{
            if( day > 10 ){
                datetime[y][m] = 1;
                rs = true;
            }
            else rs = false;
        }

        return rs;
    }).append('line').attr('x1', function(d){
        return x( d.date );
    }).attr('y1', 0).attr('x2', function(d){
        return x( d.date );
    }).attr('y2', height).attr('stroke-dasharray', '5 5');
    for(m = 0; m < n; m++){
        (function(k){
            point.filter(function(d){
                return d[keys[k]]
            }).append('circle').attr({
                cx: function(d){
                    return x( d.date );
                },
                cy: function(d){
                    return y( d[keys[k]] || 0 );
                },
                r: 4,
                fill: '#fff',
                stroke: fill[k],
                'stroke-width': 1
            }).on({
                mouseover: function(d){
                    showToolTip.call(this, d, k);
                },
                mouseout: hideToolTip
            });
        })(m);
    }

//	var stack = d3.layout.stack(),
//
//		dataset = [],
//		keys = ['bc1', 'bc2', 'cmb', 'ccb'],
//		key,
//		m, n = data.length,
//		d,
//		temp;
//
//	i = 0;
//	j = 4;
//	for(; i < j; i++){
//		key = keys[i];
//		temp = [];
//
//		for(m = 0; m < n; m++){
//			d = data[m];
//
//			temp.push({
//				x: m,
//				date: d.date,
//				y: d[key] || 0
//			});
//		}
//
//		dataset.push(temp);
//	}
//
//	stack( dataset );
//
//	var groups = svg.selectAll('g.bar').data( dataset ).enter().append('g').attr('class','bar').style('fill', function(d, i){
//		return fill[i];
//	});
//	groups.selectAll('rect').data(function(d){
//		return d;
//	}).enter().append('rect').attr({
//		x: function(d, i){
//			return x(d.date) -2;
//		},
//		y: function(d, i){
//			return  y(d.y0) + y(d.y) - height;
//		},
//		height: function(d){
//			return height - y(d.y);
//		},
//		width: 4
//	});

	// 坐标轴
	svg.append('g').attr('class', 'axis x').attr('transform', 'translate(0, 400)').call( xAxis );
	svg.append('g').attr('class', 'axis y').call( yAxis );
});
</script>
</body>
</html>