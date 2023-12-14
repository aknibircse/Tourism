<style>
    #uni_modal .modal-content>.modal-footer{
        display:none;
    }
</style>
<div class="container-fluid">
    <form action="" id="rate-review">
            <input name="package_id" type="hidden" value="<?php echo $_GET['id'] ?>" >
        <div class="form-group">
            <label for="" class="control-label">Rate</label>
            <div class="stars">
                    <input value="5" class="star star-5" id="star-5" type="radio" name="rate" /> <label class="star star-5" for="star-5"></label> 
                    <input value="4" class="star star-4" id="star-4" type="radio" name="rate" /> <label class="star star-4" for="star-4"></label> 
                    <input value="3" class="star star-3" id="star-3" type="radio" name="rate" /> <label class="star star-3" for="star-3"></label> 
                    <input value="2" class="star star-2" id="star-2" type="radio" name="rate" /> <label class="star star-2" for="star-2"></label> 
                    <input value="1" class="star star-1" id="star-1" type="radio" name="rate" checked/> <label class="star star-1" for="star-1"></label> 
            </div>
        </div>
        <div class="form-group">
            <label for="review" class="control-label">Feedback</label>
            <textarea name="review" id="review" cols="30" rows="10" class="form form-control summernote"></textarea>
        </div>

    </form>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" id='submit' onclick="$('#uni_modal form').submit()">Submit</button>
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
</div>
<script>
    $(function(){
        $('#rate-review').submit(function(e){
            e.preventDefault();
            start_loader()
            $.ajax({
                url:_base_url_+"classes/Master.php?f=rate_review",
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
                        alert_toast("Rate and Review Successfully submitted.")
                        setTimeout(() => {
                                location.reload()
                        }, 1500);
                    }else{
                        console.log(resp)
                        alert_toast("an error occured",'error')
                    end_loader()
                    }
                }
            })
        })
        $('.summernote').summernote({
		        height: 200,
		        toolbar: [
		            [ 'style', [ 'style' ] ],
		            [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
		            [ 'fontname', [ 'fontname' ] ],
		            [ 'fontsize', [ 'fontsize' ] ],
		            [ 'color', [ 'color' ] ],
		            [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
		            [ 'table', [ 'table' ] ],
		            [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
		        ]
		    })
    })
</script>