jQuery(document).ready(function(){function e(e){var t={};e.each(function(e,i){t[e]={},t[e].id=jQuery(this).attr("data-id"),t[e].title=jQuery(this).parents(".slide-image").find(".slide_title").val(),t[e].description=jQuery(this).parents(".slide-image").find("textarea").val(),t[e].url=jQuery(this).parents(".slide-image").find(".rtslider_link").val(),t[e].cta=jQuery(this).parents(".slide-image").find(".cta_button").val()});var i=JSON.stringify(t);return i}function t(){jQuery(".slide_thumbs").on("click","h2",function(){jQuery(this).siblings().slideToggle(200,"swing",function(){jQuery(this).is(":visible")?jQuery(this).parents(".slide-image").find("span.dashicons").attr("class","dashicons dashicons-arrow-up-alt2"):jQuery(this).parents(".slide-image").find("span.dashicons").attr("class","dashicons dashicons-arrow-down-alt2")})})}jQuery("#post_search").on("input",function(){var e=jQuery(this).val();return""===e?void jQuery(this).html(""):(data={action:"post_title_list",post_title:e},void jQuery.post(ajaxurl,data,function(e){e&&jQuery("#search-results").html(e)}))}),jQuery("#search-results").on("click","li",function(){var e=jQuery(this).text();jQuery("#post_search").val(e).trigger("change"),jQuery(this).parents("#search-results").html("")}),jQuery("body").on("click",".add_slide_button",function(){var t=jQuery(this).closest(".slider-container").find(".slide_thumbs"),i=jQuery(this).closest(".slider-container").find(".slide_values");if("undefined"!=typeof wp&&wp.media){var s=new wp.media.view.MediaFrame.Select({title:"Select an Image for Slider",button:{text:"Add Slide"},multiple:!1});event.preventDefault(),s.open(),s.on("select",function(){var a=s.state().get("selection").first().toJSON(),r=a.compat.item,n=new DOMParser,l=n.parseFromString(r,"text/html"),d=l.getElementsByTagName("input")[1].value,u=l.getElementsByTagName("input")[2].value;t.append('<div class="slide-image"><h2><span>Slide</span><span class="dashicons dashicons-arrow-up-alt2"></span></h2><div class="img-container"><img src="'+a.url+'" data-id="'+a.id+'"></div><div class="slide-title"><h3>Title</h3><input type="text" class="text slide_title" value="'+a.title+'"><br></div><div class="slide-description"><h3>Description</h3><textarea style="width: 100%">'+a.description+'</textarea><br></div><div class="slide-url"><h3>Slide URL</h3><input type="text" class="text rtslider_link" value="'+d+'"><br></div><div class="slide-cta"><h3>CTA Button Text</h3><input type="text" class="text cta_button" value="'+u+'"><br></div><button type="button" class="button remove_slide_button">Remove Slide</button></div>');var o=e(jQuery(".slide_thumbs").find("img"));jQuery(i).val(o).trigger("change")})}}),jQuery(".slide_thumbs input, .slide_thumbs textarea").on("input propertychange paste",function(){var t=e(jQuery(".slide_thumbs").find("img")),i=jQuery(this).closest(".slider-container").find(".slide_values");jQuery(i).val(t).trigger("change")}),jQuery(".reset_slide_button").click(function(){var e=jQuery(this).closest(".slider-container").find(".slide_thumbs"),t=jQuery(this).closest(".slider-container").find(".slide_values");""!=e.html()&&(e.find("div").remove(),t.val("").trigger("change"))}),jQuery("body").on("click",".remove_slide_button",function(){var t=jQuery(this).closest(".slider-container").find(".slide_values");jQuery(this).parent().remove();var i=e(jQuery(".slide_thumbs").find("img"));jQuery(t).val(i).trigger("change")}),jQuery(".slide_thumbs h2").siblings().hide(),t()});