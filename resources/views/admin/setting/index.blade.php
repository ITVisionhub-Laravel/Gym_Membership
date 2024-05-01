<x-admin>
    <div class="container my-3">
        <x-successmessage />
        <x-errormessage />

        <form action="{{ route('setting.store') }}" method="post">
            @csrf
            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">Website</h3>
                </div>
                <div class="card-body">
                    <div class="row">

                        <x-forms.forminput name="website_name" type="text" placeholder="Enter Website Name"
                            value="{{ $setting->website_name ?? '' }}" width="col-md-6" />

                        <x-forms.forminput name="website_url" type="text" placeholder="Enter Website URL"
                            value="{{ $setting->website_url ?? '' }}" width="col-md-6" />

                        <x-forms.forminput name="page_title" type="text" placeholder="Enter Page Title"
                            value="{{ $setting->page_title ?? '' }}" width="col-md-6" />

                        <x-forms.forminput name="meta_keyword" type="text" placeholder="Enter Meta Key"
                            value="{{ $setting->meta_keyword ?? '' }}" width="col-md-6" />

                        <x-forms.forminput name="meta_description" type="text" placeholder="Enter Meta Description"
                            value="{{ $setting->meta_description ?? '' }}" width="col-md-12" />

                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">Website -Information </h3>
                </div>

                <div class="card-body">
                    <div class="row">

                        <x-forms.forminput name="address" type="text" placeholder="Address"
                            value="{{ $setting->address ?? '' }}" width="col-md-12" />

                        <x-forms.forminput name="phone" type="text" placeholder="09*******"
                            value="{{ $setting->phone ?? '' }}" width="col-md-6" />

                        <x-forms.forminput name="email" type="text" placeholder="example@gmail.com"
                            value="{{ $setting->email ?? '' }}" width="col-md-6" />

                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header bg-primary">
                    <h3 class="text-white mb-0">Website - Social Media</h3>
                </div>
                <div class="card-body">
                    <div class="row">

                        <x-forms.forminput name="facebook" type="text" placeholder="Enter your facebook url"
                            value="{{ $setting->facebook ?? '' }}" width="col-md-6" />
                        <x-forms.forminput name="twitter" type="text" placeholder="Enter your twitter url"
                            value="{{ $setting->twitter ?? '' }}" width="col-md-6" />
                        <x-forms.forminput name="instagram" type="text" placeholder="Enter your instagram url"
                            value="{{ $setting->instagram ?? '' }}" width="col-md-6" />

                    </div>
                </div>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary text-white">Save Setting</button>
            </div>
        </form>
    </div>

    <x-slot name="scripts">
        <script>
            $(document).ready(function() {
                $('#myTable').DataTable();
            });
        </script>
    </x-slot>
</x-admin>
