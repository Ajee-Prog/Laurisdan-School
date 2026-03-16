@extends('layouts.app');

@section('content')

<section class="py-3 text-center">
    <div class="container">
        <div class="row">
            <div class="card shadow-sm mb-3 mt-3">
                <div class="card-body">
                    <h5>VISION</h5>

                    {{-- <p>Email: {{ $student->email ?? 'N/A' }}</p> --}}
                    {{-- <p><strong> Admission No: </strong> {{ $student->admission_no }}</p> --}}
                    <p><strong> Giving children a firm foundation academically, morally and spiritually </strong> </p>
                    <p> <strong>Class: </strong> </p>
                    <p> <strong>Parent Contact: </strong> </p>

                    <a href="{{route('profile.show')}}" class="btn btn-info btn-sm">View Profile</a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="pt-3">
    <div class="row">
         <div class="card shadow-sm mb-3 mt-3">
                <div class="card-body">
                    <h5>OUR VALUES</h5>

                    {{-- <p>Email: {{ $student->email ?? 'N/A' }}</p> --}}
                    {{-- <p><strong> Admission No: </strong> {{ $student->admission_no }}</p> --}}
                    <ul>
                        <li>To put God first in all things</li>
                        <li> To strive for academic</li>
                        <li> To show integrity in all actions</li>
                        <li> To crave for effective learning and creativity</li>
                        <li>Team work and cooperation</li>
                        <li> Good citizenship</li>
                    </ul>
                    <p><strong> Student Code: </strong> </p>
                    <p> <strong>Class: </strong> </p>
                    <p> <strong>Parent Contact: </strong> </p>

                    <a href="{{route('profile.show')}}" class="btn btn-info btn-sm">View Profile</a>
                </div>
            </div>
    </div>
</section>

@endsection
