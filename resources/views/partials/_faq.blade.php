<div class="modal fade" id="faqModal" tabindex="-1" role="dialog" aria-labelledby="faqModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="faqModalLabel">Впросы / Ответы</h4>
            </div>
            <div class="modal-body">
                @if ($faq)
                    <ul class="faq" id="faq">
                        @foreach ($faq as $value)
                            <li class="question"><a href="#">{{ $value->question }}</a></li>
                            <li class="answer" style="display: none;">{!! $value->answer !!}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Закрыть</button>
            </div>
        </div>
    </div>
</div>