jQuery(document).ready(function(){jQuery("#post_search").on("input",function(){var t=jQuery(this).val();return""===t?void jQuery(this).html(""):(data={action:"post_title_list",post_title:t},void jQuery.post(ajaxurl,data,function(t){t&&jQuery("#search-results").html(t)}))}),jQuery("#search-results").on("click","li",function(){var t=jQuery(this).text();jQuery("#post_search").val(t).trigger("change"),jQuery(this).parents("#search-results").html("")})});