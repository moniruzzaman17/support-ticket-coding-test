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
          
          <form method="POST" action="{{ route('tickets.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="row g-3 mb-3">
                <div class="col">
                    <label for="name" class="form-label">Full Name <span class="text-danger">*</span></label>
                    <input type="text" id="name" class="form-control" name="name" value="{{ auth()->check() ? auth()->user()->name : old('name') }}" required="">
                </div>
                <div class="col">
                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                    <input type="email" id="email" class="form-control" name="email" value="{{ auth()->check() ? auth()->user()->email : old('email') }}" required="">
                </div>
            </div>          
  
            <div class="mb-3">
                <label for="subject" class="form-label">Subject <span class="text-danger">*</span></label>
                <input type="text" id="subject" class="form-control" name="subject" value="{{ old('subject') }}" required="">
            </div>
            
            <div class="row g-3 mb-3">
              <div class="col">
                  <div class="mb-3">
                    <label for="category" class="form-label">Category <span class="text-danger">*</span></label>
                    <select id="category" class="form-select" name="category" required="">
                      <option disabled {{ old('category') ? '' : 'selected' }}>-- Select Category --</option>
                      @foreach($categories as $category)
                          <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : '' }}>
                              {{ $category->name }}
                          </option>
                      @endforeach
                  </select>
                  </div>
              </div>
              <div class="col">
                <label for="priority" class="form-label">Priority <span class="text-danger">*</span></label>
                <select id="priority" class="form-select" name="priority" required="">
                  <option disabled {{ old('priority') ? '' : 'selected' }}>-- Select Priority --</option>
                  <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                  <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                  <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                </select>
              </div>
            </div>
    
            <div class="mb-3">
              <label for="message" class="form-label">Message <span class="text-danger">*</span></label>
              <textarea id="editor" class="form-control" name="message" rows="12" required="">{!! old('message') !!}</textarea>
            </div>
            <div class="border-top pt-3 clearfix">
              <button type="submit" class="btn btn-primary float-end">Submit</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>  
@endsection
