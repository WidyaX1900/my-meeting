{{-- Modal add data meeting room --}}
<div class="modal fade" id="addMeetingRoomFormModal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addMeetingRoomForm">
                @csrf
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Add Meeting Room</h1>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Meeting Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Full Name..."
                            name="name">
                        <div id="name-error" style="font-size: 14px" class="text-danger ajax-error"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button id="saveStudentBtn" type="submit" class="btn btn-primary">
                        <i class="fa-solid fa-floppy-disk me-1"></i> Save Meeting
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>