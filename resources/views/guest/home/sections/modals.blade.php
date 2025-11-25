
{{-- ERROR INDICATOR --}}
@if($errors->any())
    <span id="modal-error-indicator" hidden></span>
@endif

{{-- SUCCESS INDICATOR --}}
@if(session('success'))
    <span id="modal-success-indicator" hidden></span>
@endif

{{-- ERROR MODAL --}}
@if($errors->any())
<div class="modal fade" id="errorModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-danger">

            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title">Error</h5>
                <button class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body bg-light-danger">
                <ul>
                    @foreach ($errors->all() as $err)
                        <li>{{ $err }}</li>
                    @endforeach
                </ul>
            </div>

        </div>
    </div>
</div>
@endif

{{-- SUCCESS MODAL --}}
@if(session('success'))
<div class="modal fade" id="successModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-success">

            <div class="modal-header text-success">
                <h5 class="modal-title">Success</h5>
                <button class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body bg-light-success">
                {{ session('success') }}
            </div>

        </div>
    </div>
</div>
@endif
