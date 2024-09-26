@extends('frontend.layouts.app')
@section('content')
<div class="container-fluid p-5" style="background-color:#F2F3F4;">
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <div class="alert alert-success text-center" role="alert">
          Your message is very important to us. Based on the issue and critical type, the support team will respond asap. Please allow some time for our support team to respond.
        </div>
        <div class="shadow-sm wrapper p-4" style="background-color:#ffffff;">
          <h3 class="h5 mb-4 fw-bold border-bottom pb-2">Open New Ticket</h3>
          <div class="mb-3">
              <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
              <input type="text" id="subject" class="form-control" name="subject" required="">
          </div>
          <div class="row g-3 mb-3">
            <div class="col">
                <div class="mb-3">
                  <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                  <select id="category" class="form-select search-disabled" name="category" data-placeholder="Select Category" required="" style="width: 100%;">
                    <option selected disabled>-- Select Category --</option>
                    <option value="4">Customer Relation</option>
                    <option value="3">Accounts</option>
                    <option value="2">NOC Support</option>
                  </select>
                </div>
            </div>
            <div class="col">
              <label for="priority" class="form-label">Priority <span class="text-danger">*</span></label>
              <select id="priority" class="form-select search-disabled" name="priority" data-placeholder="Choose Priority" required="" style="width: 100%;">
                <option selected disabled>-- Select Priority --</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
              </select>
            </div>
          </div>
  
          <div class="mb-3">
            <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
            <textarea id="editor" class="form-control" name="message" rows="12" required=""></textarea>
          </div>
  
          <div class="mb-3">
            <label for="attachment" class="form-label">Attach File(s)</label>
            <input type="file" class="d-block" id="attachment" name="attachment" accept=".csv,image/jpeg,image/jpg,image/png,image/bmp,image/gif,application/pdf,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" multiple>
            <small id="attachment-guide" class="form-text">Only JPEG, JPG, PNG, BMP, GIF, PDF, CSV, XLS, and XLSX formats are allowed.</small>
          </div>
  
          <div class="response-message"></div>
  
          <div class="border-top pt-3 clearfix">
            <button type="button" class="btn btn-primary float-end">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>  
@endsection