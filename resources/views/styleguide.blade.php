@extends('layouts.dashboard')

@section('content')
<div class="px-6 pb-5 mt-10">
    <h2 class="pb-3">Slider</h2>

    <div class="mt-5 w-1/2">
        <vue-slider :value.sync="value"></vue-slider>
    </div>
</div>

<div class="px-6 pb-5">
    <h2 class="pb-3">Switch</h2>

    <div class="mt-5 flex">
        <toggle-button :value="false" />
    </div>

    <div class="mt-5 flex">
        <toggle-button :value="true" />
    </div>
</div>

<div class="px-6 pb-5">
    <h2 class="pb-3">Select</h2>

    <div class="mt-5 md:w-1/2">
        <label class="w-full select">
            Form Label
            <select>
                <option>Payout Question</option>
                <option>General Discomfort</option>
                <option>Fallen and Can't Get Up</option>
            </select>
        </label>
    </div>

    <div class="mt-5 md:w-1/2">
        <label class="w-full">Form Label</label>
        <span class="block mt-2">
            <v-select v-model="selected" :searchable="false" :options="['Question 1', 'Question 2', 'Question 3']"></v-select>
        </span>
    </div>
</div>

<div class="px-6 pb-5 mt-10">
    <h2 class="pb-3">Inputs</h2>

    <div class="mt-5 flex md:w-1/2">
        <input type="text" placeholder="E-Mail Address" />
    </div>

    <div class="mt-5 flex md:w-1/2">
        <input type="text" placeholder="E-Mail Address" class="input-focus" />
    </div>

    <div class="mt-5 flex md:w-1/2">
        <input type="text" placeholder="E-Mail Address" class="input-error" />
    </div>
</div>

<div class="px-6 pb-5">
    <h2 class="pb-3">Buttons</h2>

    <div class="mt-5 flex">
        <a class="mr-3 button-prev" href="#">
            <span><i class="far fa-angle-left"></i></span> Prev
        </a>

        <a class="mr-3 button-prev button-prev-hover" href="#">
            <span><i class="far fa-angle-left"></i></span> Prev
        </a>
    </div>

    <div class="mt-5 flex">
        <a class="mr-3 button-next" href="#">
            Next <span><i class="far fa-angle-right"></i></span>
        </a>

        <a class="mr-3 button-next button-next-hover" href="#">
            Next <span><i class="far fa-angle-right"></i></span>
        </a>
    </div>

    <div class="mt-5 flex">
        <a class="mr-3 button-grey" href="#">Hour</a>
        <a class="mr-3 button-grey button-grey-hover" href="#">Day</a>
    </div>

    <div class="mt-5 flex">
        <a class="mr-3 button-green" href="#">Hour</a>
        <a class="mr-3 button-green button-green-hover" href="#">Day</a>
    </div>
</div>

<div class="px-6 pb-5 mt-10">
    <h2 class="pb-3">Frequency</h2>

    <div class="mt-5 flex">
        <a class="mr-3 button-ghost" href="#">Hour</a>
        <a class="mr-3 button-ghost" href="#">Day</a>
        <a class="mr-3 button-ghost" href="#">Week</a>
        <a class="mr-3 button-ghost" href="#">Month</a>
        <a class="mr-3 button-ghost" href="#">Year</a>
    </div>

    <div class="mt-5 flex">
        <a class="mr-3 button-ghost" href="#">Hour</a>
        <a class="mr-3 button-ghost button-active" href="#">Day</a>
        <a class="mr-3 button-ghost" href="#">Week</a>
        <a class="mr-3 button-ghost" href="#">Month</a>
        <a class="mr-3 button-ghost" href="#">Year</a>
    </div>

    <div class="mt-5 flex">
        <a class="mr-3 button-ghost" href="#">Hour</a>
        <a class="mr-3 button-ghost button-ghost-hover" href="#">Day</a>
        <a class="mr-3 button-ghost" href="#">Week</a>
        <a class="mr-3 button-ghost" href="#">Month</a>
        <a class="mr-3 button-ghost" href="#">Year</a>
    </div>
</div>

<div class="px-6 pb-5">
    <h2 class="pb-3">Tabs</h2>

    <ul class="tabs">
        <li><a href="#">Voters</a></li>
        <li><a href="#">Payout</a></li>
        <li><a href="#">Payout</a></li>
        <li><a href="#" class="active">Server</a></li>
    </ul>
</div>

<div class="px-6 pb-5">
    <h2 class="pb-3">Checkboxes</h2>

    <input type="checkbox" />
    <input type="checkbox" checked />
    <input type="checkbox" disabled />
    <input type="checkbox" disabled checked />
</div>

<div class="px-6 pb-5">
    <h2 class="pb-3">Radio</h2>

    <input type="radio" />
    <input type="radio" checked />
    <input type="radio" disabled />
    <input type="radio" disabled checked />
</div>

<div class="px-6">
    <h2 class="pb-3">Alerts</h2>

    <div class="alert-info mb-10 md:w-1/2">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus harum numquam reiciendis itaque obcaecati, dolore dolores vero rem quasi dolor eos sit doloribus molestiae accusamus, eligendi fugit optio minima praesentium.</p>
    </div>

    <div class="alert-success mb-10 md:w-1/2">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus harum numquam reiciendis itaque obcaecati, dolore dolores vero rem quasi dolor eos sit doloribus molestiae accusamus, eligendi fugit optio minima praesentium.</p>
    </div>

    <div class="alert-warning mb-10 md:w-1/2">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus harum numquam reiciendis itaque obcaecati, dolore dolores vero rem quasi dolor eos sit doloribus molestiae accusamus, eligendi fugit optio minima praesentium.</p>
    </div>

    <div class="alert-danger mb-10 md:w-1/2">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Natus harum numquam reiciendis itaque obcaecati, dolore dolores vero rem quasi dolor eos sit doloribus molestiae accusamus, eligendi fugit optio minima praesentium.</p>
    </div>
</div>
@endsection
