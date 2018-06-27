// ==UserScript==
// @name         Get Jogos
// @namespace    http://tampermonkey.net/
// @version      0.1
// @description  try to take over the world!
// @author       You
// @match        https://www.totalcorner.com/
// @grant        none
// ==/UserScript==



function getJogos(data, page){
	var obj=[];
	$.get('/match/schedule/'+data+'/page:'+page, function(res){	
		var data_inicio=$(res).find('h3 small').text();
		$(res).find('tr[data-match_id]').each(function(){ 
			var id=$(this).attr('data-match_id'); 
			var data_hora=data_inicio+' '+$(this).find('td:eq(2)').text();
			var home=$(this).find('.match_home a').text(); 
			var away=$(this).find('.match_away a').text(); 
			var placar=$(this).find('.match_goal').text().split(' - ');
			var corners_half=$(this).find('.span_half_corner').eq(0).text().replace('(','').replace(')','').split('-');
			var da=$(this).find('.match_dangerous_attacks_half_div').text().split(' - ');
			var shoots=$(this).find('.match_shoot_half_div').text().split(' - ');
			
			
		
			
			obj.push({
				id: Number(id),
				data_inicio: data_hora, 
				home: home,
				away: away,
				ghf: Number(placar[0]),
				gaf: Number(placar[1]),
				ch: Number(corners_half[0]),
				ca: Number(corners_half[1]),
				dah: Number(da[0]),
				daa: Number(da[1]),
				sh: Number(shoots[0]),
				sa: Number(shoots[1]),
				data_page: data 	 			
			});
			 
		});	
		
		//console.log(obj);
			            
		$.ajax({
			type: 'POST',
			url: 'https://aposte.me/totalcorner_stats_half/insert_jogos.php',
			data: JSON.stringify (obj),
			success: function(res_insert) {
			    console.log(res_insert)
			},
			contentType: "application/json",
			dataType: 'json'
		});	
	});	

}


setInterval(function(){
	$.get('https://aposte.me/totalcorner_stats_half/select_jogos.php', function(obj){
		obj=JSON.parse(obj);
		for(var i=1; i<=obj.n_pages; i++){
			getJogos(obj.data, i);
		}
	});

},6*1000);



