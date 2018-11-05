// ==UserScript==
// @name         Get Odds
// @namespace    http://tampermonkey.net/
// @version      0.1
// @description  try to take over the world!
// @author       You
// @match        https://www.totalcorner.com/
// @grant        none
// ==/UserScript==





function ajustaHandicap(str){
    var arr=str.split(',');
    if (arr.length==1) arr[1]=arr[0];
    return (Number(arr[0])+ Number(arr[1]))/2.0;
    
}


function getOdds(jogo_id){
    var obj={};
    $.get('https://www.totalcorner.com/match/odds-handicap/'+jogo_id, function(res){
        var tr=$(res).find("#goals_full tr:contains(half):last");
        if (tr.size()==0) tr=$(res).find("#goals_full tr:contains(45 '):last");
        obj={
            jogo_id: Number(jogo_id),
            gh: Number(tr.find('td:eq(1)').text().split(' - ')[0]),
            ga: Number(tr.find('td:eq(1)').text().split(' - ')[1]),
            oo: Number(tr.find('td:eq(2)').text()),
            goalline: ajustaHandicap(tr.find('td:eq(3)').text()),
            ou: Number(tr.find('td:eq(4)').text())
        };
        var tr=$(res).find("#handicap_full tr:contains(half):last");
        if (tr.size()==0) tr=$(res).find("#handicap_full tr:contains(45 '):last");
        obj.oh=Number(tr.find('td:eq(2)').text());
        obj.handicap=ajustaHandicap(tr.find('td:eq(3)').text());
        obj.oa=Number(tr.find('td:eq(4)').text());  
        
        
        
        $.ajax({
            type: 'POST',
            url: 'https://bot-ao.com/half/insert_odds.php',
            data: JSON.stringify (obj),
            success: function(data) {  
                console.log(data)
            },
            contentType: "application/json",
            dataType: 'json'
        });    
    });
}


setInterval(function(){
	$.get('https://bot-ao.com/half/select_odds.php', function(jogo_id){
		getOdds(jogo_id);	
	});
},5*1000);


setInterval(function(){
   location.reload();
},5*60*1000);
