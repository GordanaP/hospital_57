<div class="modal fade" tabindex="-1" role="dialog" id="appModal">
    <div class="modal-dialog" role="document">
        <form  id="appForm">
            <div class="modal-content">

                <div class="modal-header">
                    <h4 class="modal-title text-grey-darker">
                        <i class="mr-1 fa"></i>
                        <span class="ls-1"></span>
                    </h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>

                @include('appointments.forms._save')

            </div><!-- /.modal-content -->
        </form>
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->