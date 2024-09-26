
<div class="accordion" id="customerInfoWrapper">
    <div class="accordion-item">
      <h2 id="singleHeadingFirst" class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#customerInfo" aria-expanded="true" aria-controls="customerInfo">
            <i class="fas fa-user"></i> &nbsp; {{ Auth::guard('customer')->user()->name }}
        </button>
      </h2>
      <div id="customerInfo" class="accordion-collapse collapse show" aria-labelledby="singleHeadingFirst">
        <div class="accordion-body">
          <p class="mb-0">Name: {{ Auth::guard('customer')->user()->name }}</p>
          <p class="mb-0">Email: {{ Auth::guard('customer')->user()->email }}</p>
        </div>
      </div>
    </div>
</div>
{{-- <div class="accordion mt-3" id="infoWrpper">
    <div class="accordion-item">
      <h2 id="singleHeadingFirst" class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#ticketStatus" aria-expanded="true" aria-controls="ticketStatus">
            <i class="fas fa-filter"></i>&nbsp; Ticket Status
        </button>
      </h2>
      <div id="ticketStatus" class="accordion-collapse collapse show" aria-labelledby="singleHeadingFirst">
        <div class="accordion-body">
          Overview of the basic fundamentals of robot kinesiology, including rotational motion, laws of thermodynamics, space, time, and momentum. Students will learn to analyze and explain workings and gesticulations, identify and describe metals and fluids at rest and in motion, and explain the impact that the laws of gravity have on different forms of energy.
        </div>
      </div>
    </div>
</div> --}}
<div class="accordion mt-3" id="menuWrapper">
    <div class="accordion-item">
      <h2 id="menuac" class="accordion-header">
        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#menuaccordion" aria-expanded="true" aria-controls="menuaccordion">
            <i class="fas fa-filter"></i>&nbsp; Ticket Status
        </button>
      </h2>
      <div id="menuaccordion" class="accordion-collapse collapse show" aria-labelledby="menuac">
        <div class="accordion-body">
            <ul class="nav nav-pills flex-column mb-auto">
                <li class="nav-item">
                    <a href="{{ route('index') }}" class="nav-link text-dark" aria-current="page">
                        <i class="fas fa-home"></i> Home
                    </a>
                </li>
                <li>
                    <a href="{{ route('open.ticket') }}" class="nav-link text-dark">
                      <i class="fas fa-ticket-alt"></i> New Ticket
                    </a>
                </li>
            </ul>
        </div>
      </div>
    </div>
</div>
