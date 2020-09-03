@component('mail::message')
    @if($files !=0)
        # Hello,
        Attached the results of the analysis of your project.
        PS: The results are in Markdown formats, here is a link to read online if you don't have any tools => https://stackedit.io/app
    @else
        # Hello,
            After analyzing your repository, we are pleased to announce that no fail has been detected !
    @endif

    {{ config('app.name') }} team
@endcomponent
