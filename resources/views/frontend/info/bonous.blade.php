@extends('frontend.layouts.master', ['title' => ' Bonous Section'])
@section('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"
        integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
@endsection
@section('main-content')
    <!-- SERVICE AREA START (Service 1) -->
    <div class="ltn__service-area section-bg-1  pb-70">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title-area ltn__section-title-2--- text-center">
                        {{-- <h6 class="section-subtitle section-subtitle-2 ltn__secondary-color">Our Services</h6> --}}
                        <h1 class="section-title">Our Core Services</h1>
                    </div>
                </div>
            </div>
            <div class="row  justify-content-center">

                <x-bonous-card :target="'#ex1'" :img="config('settings.bonous_1_img')" :title="session()->get('locale') == 'mm'?config('settings.bonous_1_title_mm'):config('settings.bonous_1_title') ?? 'Title 1'">
                    {{ session()->get('locale') == 'mm'?config('settings.bonous_1_txt_mm'):config('settings.bonous_1_txt') ?? 'Txt 1' }}
                </x-bonous-card>

                <x-bonous-card :target="'#ex2'" :img="config('settings.bonous_2_img')" :title="session()->get('locale') == 'mm'?config('settings.bonous_2_title_mm'):config('settings.bonous_2_title') ?? 'Title 2'">
                    {{ session()->get('locale') == 'mm'?config('settings.bonous_2_txt_mm'):config('settings.bonous_2_txt') ?? 'Txt 2' }}
                </x-bonous-card>

                <x-bonous-card :target="'#ex3'" :img="config('settings.bonous_3_img')" :title="session()->get('locale') == 'mm'?config('settings.bonous_3_title_mm'):config('settings.bonous_3_title') ?? 'Title 3'">
                    {{ session()->get('locale') == 'mm'?config('settings.bonous_3_txt_mm'):config('settings.bonous_3_txt') ?? 'Txt 3' }}
                </x-bonous-card>

                <x-bonous-card :target="'#ex4'" :img="config('settings.bonous_4_img')" :title="session()->get('locale') == 'mm'?config('settings.bonous_4_title_mm'):config('settings.bonous_4_title') ?? 'Title 4'">
                    {{ session()->get('locale') == 'mm'?config('settings.bonous_4_txt_mm'):config('settings.bonous_4_txt') ?? 'Txt 4' }}
                </x-bonous-card>

                <x-bonous-card :target="'#ex5'" :img="config('settings.bonous_5_img')" :title="session()->get('locale') == 'mm'?config('settings.bonous_5_title_mm'):config('settings.bonous_5_title') ?? 'Title 5'">
                    {{ session()->get('locale') == 'mm'?config('settings.bonous_5_txt_mm'):config('settings.bonous_5_txt') ?? 'Txt 5' }}
                </x-bonous-card>

                <x-bonous-card :target="'#ex6'" :img="config('settings.bonous_6_img')" :title="session()->get('locale') == 'mm'?config('settings.bonous_6_title_mm'):config('settings.bonous_6_title') ?? 'Title 6'">
                    {{ session()->get('locale') == 'mm'?config('settings.bonous_6_txt_mm'):config('settings.bonous_6_txt') ?? 'Txt 6' }}
                </x-bonous-card>

                <x-bonous-modal :title="session()->get('locale') == 'mm'?config('settings.bonous_1_title_mm'):config('settings.bonous_1_title') ?? 'Title 1'" :img="config('settings.bonous_1_img')" id="ex1" aria-labelledby="ex1Label">
                    <p class="px-2">
                        {{ session()->get('locale') == 'mm'?config('settings.bonous_1_txt_mm'):config('settings.bonous_1_txt') ?? 'Txt 1' }}
                    </p>
                </x-bonous-modal>
                <x-bonous-modal :title="session()->get('locale') == 'mm'?config('settings.bonous_2_title_mm'):config('settings.bonous_2_title') ?? 'Title 2'" :img="config('settings.bonous_2_img')" id="ex2" aria-labelledby="ex2Label">
                    <p class="px-2">
                        {{ session()->get('locale') == 'mm'?config('settings.bonous_2_txt_mm'):config('settings.bonous_2_txt') ?? 'Txt 2' }}
                    </p>
                </x-bonous-modal>
                <x-bonous-modal :title="session()->get('locale') == 'mm'?config('settings.bonous_3_title_mm'):config('settings.bonous_3_title') ?? 'Title 3'" :img="config('settings.bonous_3_img')" id="ex3" aria-labelledby="ex3Label">
                    <p class="px-2">
                        {{ session()->get('locale') == 'mm'?config('settings.bonous_3_txt_mm'):config('settings.bonous_3_txt') ?? 'Txt 3' }}
                    </p>
                </x-bonous-modal>
                <x-bonous-modal :title="session()->get('locale') == 'mm'?config('settings.bonous_4_title_mm'):config('settings.bonous_4_title') ?? 'Title 4'" :img="config('settings.bonous_4_img')" id="ex4" aria-labelledby="ex4Label">
                    <p class="px-2">
                        {{ session()->get('locale') == 'mm'?config('settings.bonous_4_txt_mm'):config('settings.bonous_4_txt') ?? 'Txt 4' }}
                    </p>
                </x-bonous-modal>
                <x-bonous-modal :title="session()->get('locale') == 'mm'?config('settings.bonous_5_title_mm'):config('settings.bonous_5_title') ?? 'Title 5'" :img="config('settings.bonous_5_img')" id="ex5" aria-labelledby="ex5Label">
                    <p class="px-2">
                        {{ session()->get('locale') == 'mm'?config('settings.bonous_5_txt_mm'):config('settings.bonous_5_txt') ?? 'Txt 5' }}
                    </p>
                </x-bonous-modal>
                <x-bonous-modal :title="session()->get('locale') == 'mm'?config('settings.bonous_6_title_mm'):config('settings.bonous_6_title') ?? 'Title 6'" :img="config('settings.bonous_6_img')" id="ex6" aria-labelledby="ex6Label">
                    <p class="px-2">
                        {{ session()->get('locale') == 'mm'?config('settings.bonous_6_txt_mm'):config('settings.bonous_6_txt') ?? 'Txt 6' }}
                    </p>
                </x-bonous-modal>
            </div>
        </div>
    </div>
    <!-- SERVICE AREA END -->
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
@endsection
