<?php
/**
 *  todo
 * */
require_once('../include/Tag.class.php');
$tag = new Tag();
$allTag = $tag->selectTagsFullInfo();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<!--[if lt IE 9]><meta http-equiv="content-type" content="text/html; charset=utf-8" /><![endif]-->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
<title></title>
<style>
body{
    border: 0;
    margin: 0;
    padding: 0;
}
.node {
    stroke: #fff;
    stroke-width: 1.5px;
}
.link {
    stroke: #999;
    stroke-opacity: .6;
}
</style>
</head>
<body>

<script src="../script/lib/jQuery/jquery-1.10.2.min.js"></script>
<script src="../script/lib/d3/d3.v3.min.js"></script>
<script>
var TAG_DATA = <?php echo isset($allTag) ? json_encode($allTag) : '[]';?>;
$(function(){
    // 整理数据
    var i = TAG_DATA.length,
        links = [],
        temp, source,
        obj,
        m;
    while( i-- ){
        temp = TAG_DATA[i];
        source = i;

        if( temp.tagParent ){
            temp = temp.tagParent.split(',');

            m = temp.length;
            while( m-- ){
                obj = {};
                obj.source = source;
                obj.target = temp[m] -1;
                obj.value = 1;
                links.push( obj );
            }
        }
        else{}
    }

    var w = 2000,
        h = 2000,
        maxR = 50,
        minR = 10,
        color = d3.scale.category20(),
        force = d3.layout.force().charge(-1000).linkDistance(200).size([w, h]),
        svg = d3.select('body').append('svg').attr('width', w).attr('height', h),
        link,
        nodeGroup, node, tagName;

    force.nodes( TAG_DATA ).links( links ).start();

    link = svg.selectAll('.link')
        .data( links )
        .enter().append('line')
        .attr('class', 'link')
        .style('stroke-width', function(d) {
            return Math.sqrt(d.value);
        });

    nodeGroup = svg.selectAll('g')
        .data( TAG_DATA )
        .enter().append('g');

    node = nodeGroup.append('circle').attr('class', 'node')
        .attr('r', function(d){
            return Math.floor(d.tagNum /3) +10;
        })
        .style('fill', function(d){
            return color( Math.floor( Math.random() *20 ) );//(d.tagLevel || 2) +5 );
        }).call(force.drag);

    tagName = nodeGroup.append('text').text(function(d){
        return d.tagName;
    });

    force.on('tick', function(){
        link.attr('x1', function(d){
                return d.source.x;
            }).attr('y1', function(d){
                return d.source.y;
            }).attr('x2', function(d){
                return d.target.x;
            }).attr('y2', function(d){
                return d.target.y;
            });

        node.attr('cx', function(d){
                return d.x;
            }).attr('cy', function(d){
                return d.y;
            });
        tagName.attr('x', function(d){
            return d.x;
        }).attr('y', function(d){
            return d.y;
        });
    });
});
</script>
</body>
</html>