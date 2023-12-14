<?php
include '../../config.php';
if(isset($_GET['id'])){
    $qry = $conn->query("SELECT * FROM `inquiry` where id = '{$_GET['id']}' ");
    foreach($qry->fetch_assoc() as $k => $v){
        $$k = $v;
    }
    $conn->query("UPDATE `inquiry` set `status` = 1 where id = '{$_GET['id']}' ");

}
?>
<style>
    #uni_modal .modal-content>.modal-footer{
        display:none;
    }
</style>
<p><b>Inquirer:</b> <?php echo ucwords($name) ?></p>
<p><b>Inquirer's Email:</b> <?php echo $email ?></p>
<p><b>Subject:</b> <?php echo $subject ?></p>
<p><b>Message:</b></p>
<div><?php echo $subject ?></div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>

<script>
    $(function(){
        $('#book-status').submit(function(e){
            e.preventDefault();
            start_loader()
            $.ajax({
                url:_base_url_+"classes/Master.php?f=update_book_status",
                method:"POST",
                data:$(this).serialize(),
                dataType:"json",
                error:err=>{
                    console.log(err)
                    alert_toast("an error occured",'error')
                    end_loader()
                },
                success:function(resp){
                    if(typeof resp == 'object' && resp.status == 'success'){
                        location.reload()
                    }else{
                        console.log(resp)
                        alert_toast("an error occured",'error')
                    }
                    end_loader()
                }
            })
        })
    })
</script>