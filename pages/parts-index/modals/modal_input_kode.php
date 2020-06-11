<?php 


?>
<style type="text/css">
    .ttup {color: white;}
    .ttup:hover {color: black; transform: rotate(180deg); 
        -webkit-transform: rotate(180deg);
        -moz-transform: rotate(180deg); 
        transition:1s;
        -moz-transition:1s;
        -webkit-transition:1s;
    }
    .bllk{border-radius: 5px; background-color: #536878}
    .bllk:hover{ background-color: tomato; color: black}
</style>
<div class="keym modal fade" id="kodeModal" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content modal-col-blue-grey" style="border-radius: 10px;">
            <button type="button" class="bllk btn btn-sm waves-effect waves-red waves-float pull-right" data-dismiss="modal"><li class="ttup fa fa-times"></li></button>
            <div class="modal-header">
                <h4 class="modal-title" id="defaultModalLabel">Buat Kode</h4>
            </div>
            <div class="modal-body">
                <form method="post" id="myForm">
                    <div class="form-group form-float">
                        <div class="form-line">
                            <input type="text" class="form-control bg-blue-grey" name="buat_kode" maxlength="3" id="buatkode" required="">
                            <label class="form-label">Buat Kode</label>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                   
                    <button type="submit" name="ok" id="ok" class="btn btn-link btn-block waves-effect waves-cyan">OK</button>
                </div>
            </form>

        </div>
    </div>
</div>
</div>
