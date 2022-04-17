@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col s8">
            <br><br><br>
            <div class="row text-center">
                <h3 style="color: black" class="text-dark display-4 ">
                    Agregar una
                </h3>
                <h3 style="color: black" class="text-dark display-4 ">
                    característica.
                </h3>
            </div>

            <div class="row">
                <br>
            </div>

            <form method="POST" action="{{ route('characteristics.store') }}">
                @csrf
                <div class="row mb-3">
                    <label for="name" class="col-md-3 col-form-label text-md-end">{{ __('Nombre') }}</label>

                    <div class="col-md-7">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    </div>
                </div>

                <div class="row mb-6">
                    <div class="col-md-3 offset-md-5">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Crear') }}
                        </button>
                    </div>
                </div>
            </form>
            <br>
        </div>

        <div class="col s4 text-center">
            <br>
            <img src="https://lh3.googleusercontent.com/fife/AAWUweUrXqdyJAZHzRBmYKywcXtKPCwOJ8osQrJtzyHkFwYam13GLCOeMYDAzHl_Nqro8l9og2-MdjgFTHbvxwehdvfTOvnZr0Ttf3TZvGIpF9HEbAYzas0Z6OVE5SjfqrT-_4bc0rTgbx9nbct5WM4qongRzS5awaZVa7JmVjbp-TKF1MiZYgN9Jsik6KjjWXWsrrvB9HvzUJQwQ98tzal-7pDHz6zRTBVus9OSh1qyY38KwtkeUTSpnhIpeD-nViTu8D6UgdxDXzTAlcOOk20FvfJGg2uVa1rKV4wHqYvkNNQ7uzXWicU-IFOJLnbCqSkQKhs6EejG5q4jge9WcxLl4A5joyRPmEoncOZndnIVGGxGFNabpdCxyeI7pTjRXQEuYhpHj2NMcOnqP3DwCRMcK_jDMnPnjQ-SlvfGW2znN5vMtX6DMpUglKGfGPjPkSPJYquYgS4DPxZMrNC1YDbbDYh-mPDKA2b4PzaqsdVYQjynrbYstxUGo4DiCs-I1euQBQ9046tA5grSMUs5YnEHAiGP1dimeLucCdw_SKD3XZtq2qFUnX9ZfjlVjiO6xn4SU02h82xrEEZbiSSCLZ8lGYVFYTtnxvqrNyiwSa9YH0kHcW7Jv3FFJGE6C3zFtl5GJ7wQ-eIfXZoVvrYGz1Wd2oiGYTH6JmYDn9jur33_BD0oOIM8R2vhN5KBUXKlxxuFZc_LlU-GBh9GS77FLGDdJAQg112uscQKSyiR3or6zzVYo-gwNyDeDYAbFgxj6-tumVJmK3QzO8fbPAgvFneM5ZEihgsQ2AHNemhL1DCkK0brCoNQcIKLXGy11rw248lK20qeFn1Vt54ImLWbgmC0O5z3_SSWsA=w1362-h903"
            class="img-fluid rounded" alt="..." width="600px">
        </div>

    </div>

    <br><br><br><br><br><br><br><br>
</div>
@endsection
