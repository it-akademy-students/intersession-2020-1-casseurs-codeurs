@component('mail::message')
    @if($files !=0)
        # Hello,<br>
        Attached the results of the analysis of your project.<br>
        PS: The results are in Markdown formats, here is a link to read online if you don't have any tools => https://stackedit.io/app<br>
    @else
        # Hello,<br>
            After analyzing your repository, we are pleased to announce that no fail has been detected !<br>
    @endif
    {{ config('app.name') }} team
@endcomponent
