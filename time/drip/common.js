$(document).ready(function(){
	$(".re_bt").click(function(){
		var params = $("form").serialize();
				$.ajax({
					type: 'post',
					url: 'reple_ok.php?=<?php echo $board["idx"]; ?>',
					data : params,
					dataType : 'html',
					success: function(data){
						$(".reply_view").html(data);
						$(".reply_content").val('');
					}
				});
			});
			$(".dat_edit_bt").click(function(){
			var obj = $(this).closest(".dap_lo").find(".dat_edit");
			obj.dialog({
				modal:true,
				width:650,
				height:200,
				title:"댓글 수정"});
		});

	$(".dat_delete_bt").click(function(){
		var obj = $(this).closest(".dap_lo").find(".dat_delete");
		obj.dialog({
			modal:true,
			width:400,
			title:"댓글 삭제확인"});
		});
});
