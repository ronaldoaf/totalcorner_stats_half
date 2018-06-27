// ==UserScript==
// @name         Get Pages
// @namespace    http://tampermonkey.net/
// @version      0.1
// @description  try to take over the world!
// @author       You
// @match        https://www.totalcorner.com/
// @grant        none
// ==/UserScript==


setInterval(function(){
    var obj={};
    $.get('https://aposte.me/totalcorner_stats_half/select_page.php', function(data){
        $.get('/match/schedule/'+data, function(res){
            obj.data=Number(data);
            obj.n_pages=$("li a[rel='last']:eq(0)").size()==0 ? 1 : Number($("li a[rel='last']:eq(0)").attr('href').split(':')[1]);
            $.ajax({
                type: 'POST',
                url: 'https://aposte.me/totalcorner_stats_half/insert_pages.php',
                data: JSON.stringify (obj),
                success: function(res_insert) {
                    console.log(res_insert)
                },
                contentType: "application/json",
                dataType: 'json'
            });
        });
    });
},5*1000);

