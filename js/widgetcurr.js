! function() {
	var e;
	if (void 0 === window.jQuery || "1.4.2" !== window.jQuery.fn.jquery) {
		var t = document.createElement("script");
		t.setAttribute("type", "text/javascript"), t.setAttribute("src", "https://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"), t.readyState ? t.onreadystatechange = function() {
			"complete" != this.readyState && "loaded" != this.readyState || n()
		} : t.onload = n, (document.getElementsByTagName("head")[0] || document.documentElement).appendChild(t)
	} else e = window.jQuery, i();

	function n() {
		e = window.jQuery.noConflict(!0), i()
	}

	function i() {
		e(document).ready(function(e) {
			e(".coinlore-coin-widget").each(function() {
				var width;
				var bwidth;
				var color;
				var symbol = '';
				var divnum = 0;
				var rank = e(this).attr("data-rank");
				var mcap = e(this).attr("data-mcap");
				var d7 = e(this).attr("data-d7");
				var vol = e(this).attr("data-vol");
				var cwidth = e(this).attr("data-cwidth");
				var bcolor = e(this).attr("data-bcolor");
				var tcolor = e(this).attr("data-tcolor");
				var ccolor = e(this).attr("data-ccolor");
				var pcolor = e(this).attr("data-pcolor");
				e.get("https://widget.coinlore.com/widgets/new-single/?id=" + e(this).attr("data-id") + "&cur=" + e(this).attr("data-mcurrency"), function(t) {
					cc = '<div style="border-radius: 10px;color:' + tcolor + ';background: ' + bcolor + ';box-shadow: 0 1px 3px 0 #ccc;font-family: Helvetica,Arial,sans-serif;min-width:285px; width:' + cwidth + '">';
					cc += '<div><div style="float:right;width:67%;border: none;text-align:left;padding:5px 0px;line-height:25px;">';
					cc += '<span style="font-size: 17px;"><a href="https://www.coinlore.com/coin/' + t[0].nameid + '" target="_blank" style="text-decoration: none; color: ' + ccolor + ';font-weight: bold">' + t[0].name + '</a><span style="font-size: 10px;padding-left: 5px">' + t[0].symbol + '</span></span>';
					if (t[0].percent_change_24h < 0) {
						color = '#c2220d!important';
					} else {
						color = '#8dc647!important';
						symbol = '+';
					}
					cc += '<div style="font-size: 16px;color:' + pcolor + '">' + t[0].price_usd + ' ' + t[0].mc + ' <span style="color:' + color + '">(' + symbol + t[0].percent_change_24h + '%)</span></div>';
					cc += '<div style="font-size: 12px; color:#959595">' + t[0].price_btc + ' BTC </div>';
					cc += '</div>';
					cc += '<div style="text-align:center;padding:5px 0px;width:33%;"><img src="https://c2.coinlore.com/img/' + t[0].nameid + '.png" width="64px" height="64px" style="margin: 0 auto;"></div>';
					cc += '</div>';
					cc += '<div style="border-top: 1px solid #e1e5ea;clear:both;">';
					if (rank == 1) divnum += 1;
					if (mcap == 1) divnum += 1;
					if (d7 == 1) divnum += 1;
					if (vol == 1) divnum += 1;
					bwidth = (100 / divnum);
					if (rank == 1) {
						cc += '<div style="text-align:center;float:left;width:' + bwidth + '%;font-size:12px;padding:12px 0;border-right:1px solid #e1e5ea;line-height:1.25em;"><b>Rank</b><br><br><span style="font-size: 17px; ">' + t[0].rank + '</span></div>';
					}
					if (mcap == 1) {
						cc += '<div style="text-align:center;float:left;width:' + bwidth + '%;font-size:12px;padding:12px 0 16px 0;border-right:1px solid #e1e5ea;line-height:1.25em;"><b>Market Ca</b>p<br><br> <span style="font-size: 14px; ">' + t[0].market_cap_usd + ' <span style="font-size:9px">USD</span></span></div>';
					}
					if (vol == 1) {
						cc += '<div style="text-align:center;float:left;width:' + bwidth + '%;font-size:12px;padding:12px 0 16px 0;line-height:1.25em;border-right:1px solid #e1e5ea;"><b>Vol (24H)</b><br><br> <span style="font-size: 14px; ">' + t[0].t24h_volume_usd + ' <span style="font-size:9px">USD</span></span></div>';
					}
					symbol = '';
					if (t[0].percent_change_7d < 0) {
						color = '#c2220d!important';
					} else {
						color = '#8dc647!important';
						symbol = '+';
					}
					if (d7 == 1) {
						cc += '<div style="text-align:center;float:left;width:' + (bwidth - 1) + '%;font-size:12px;padding:12px 0 16px 0;line-height:1.25em;"><b>7D Change</b><br><br> <span style="font-size: 14px;color: ' + color + ';">' + symbol + t[0].percent_change_7d + '<span style="font-size:9px">%</span></span></div>';
					}
					cc += '</div>';
					cc += '<div style="background: #f9fafb;box-shadow: 1px 0px 3px 0 #ccc;text-align:center;clear:both;font-size:11px;font-style:italic;padding:5px 0;"></div>';
					cc += '</div>';
					e(".coinlore-coin-widget").css("width", width);
					e(".coinlore-coin-widget").html(cc);
				})
			})
		})
	}
}();
