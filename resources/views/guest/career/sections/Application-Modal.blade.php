<!-- Application Modal -->
<div class="modal" id="applicationModal">
  <div class="modal-overlay" onclick="closeModal()"></div>
  <div class="modal-container">
    <div class="modal-header">
      <h2>Apply for <span id="positionTitle">Position</span></h2>
      <button class="modal-close" onclick="closeModal()">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <!-- Error Alert -->
    <div id="errorAlert" class="error-alert" style="display:  none;">
      <i class="fas fa-exclamation-circle"></i>
      <div>
        <strong>Error! </strong>
        <p id="errorMessage"></p>
      </div>
      <button onclick="document.getElementById('errorAlert').style.display='none'" class="close-alert">
        <i class="fas fa-times"></i>
      </button>
    </div>

    <form class="application-form" id="applicationForm" action="{{ route('career.apply') }}" method="POST" enctype="multipart/form-data">
      @csrf
      <input type="hidden" name="position_id" id="positionId" value="">

      <div class="form-row">
        <div class="form-group">
          <label>Full Name <span class="required">*</span></label>
          <input type="text" name="full_name" placeholder="Your full name" required />
        </div>

        <div class="form-group">
          <label>Email <span class="required">*</span></label>
          <input type="email" name="email" placeholder="your@email.com" required />
        </div>
      </div>

      <div class="form-row">
        <div class="form-group">
          <label>Phone Number <span class="required">*</span></label>
          <input type="tel" name="phone" placeholder="+62 8xx xxxx xxxx" required />
        </div>

        <div class="form-group">
          <label>Location (optional)</label>
          <input type="text" name="location" placeholder="City, Country" />
        </div>
      </div>

      <div class="form-group">
        <label>LinkedIn Profile (optional)</label>
        <input
          type="text"
          name="linkedin"
          placeholder="linkedin.com/in/yourprofile"
        />
      </div>

      <div class="form-group">
        <label>Resume/CV <span class="required">*</span></label>
        <div class="file-input">
          <input
            type="file"
            id="resume"
            name="resume"
            accept=".pdf,.doc,.docx"
            hidden
            required
          />
          <label for="resume" class="file-label">
            <i class="fas fa-upload"></i>
            <span class="file-text">Choose file</span>
          </label>
          <span class="file-name" id="fileName"></span>
        </div>
        <small>PDF, DOC, DOCX (Max 5MB)</small>
      </div>

      <div class="form-group">
        <label>Cover Letter</label>
        <textarea
          name="cover_letter"
          rows="5"
          placeholder="Tell us why you're interested in this position... (optional)"
        ></textarea>
        <small>Optional - Maximum 5000 characters</small>
      </div>

      <div class="form-actions">
        <button type="button" class="btn-cancel" onclick="closeModal()">
          Cancel
        </button>
        <button type="submit" class="btn-submit" id="submitBtn">
          <span id="submitText">Submit Application</span>
          <span id="submitSpinner" style="display: none;">
            <i class="fas fa-spinner fa-spin"></i> Submitting...
          </span>
        </button>
      </div>
    </form>
  </div>
</div>