<script>

$(document).ready(function(){

    $('.view_student').click(function(){
        var uid=$(this).attr("id")
        $.ajax({
            url:"view/viewstudent.php",
            method:"post",
            data:{id:uid},
            success:function(data){
                $('#data').html(data);
        //		$('#dataModal').modal('show');	
            }
        });		
    });
});

</script>