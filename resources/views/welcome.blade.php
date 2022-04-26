@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            {{-- Título --}}
            <div class="col s8">
                <br><br>
                <div class="row text-center">
                    <h3 style="color: black" class="text-dark display-3 ">
                        UAM - BNB
                    </h3>
                </div>
                <br><br>
                <div class="row text-center">
                    <h3 style="color: black" class="text-dark display-6 ">
                        El hospedaje perfecto, en el lugar perfecto
                    </h3>


                    @if (Auth::user() != null)
                    <center>
                        <div class="row  " style="margin-left: 5rem; margin-top:3rem;">
                            <div class=" col-7 card border-primary mb-3" style="max-width: 30rem; height: 22rem;">

                                <form action="{{ route('userVip', Auth::user()->id) }}" method="post"
                                    enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    {{ method_field('put') }}
                                    <div class="card-body" style="margin-top: 3rem;">
                                        <h4 class="card-title">Sé VIP</h4>
                                        <p class="card-text">Disfruta de acceso y descuentos especiales para rentar la
                                            casa
                                            de
                                            tus sueños</p>
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary">VIP</button>
                                </form>
                            </div>


                            <img class="col-auto"
                                src="https://revistaaxxis.com.co/wp-content/uploads/2021/07/imagen-21.png" alt="" style="width: 40rem;">

                        </div>
                    </center>

                    @else
                    <img class="col-auto"
                                src="https://revistaaxxis.com.co/wp-content/uploads/2021/07/imagen-21.png" alt="" class="mt-5" >


                    @endif
                </div>
                <br><br>


            </div>

        </div>
    @endsection
