<ul class="pagination pagination-sm">
    <?= $this->Paginator->first('«', ['class' => 'first', 'tag' => 'li']) ?>
    <?= $this->Paginator->prev('‹', ['tag' => 'li'], null,
        ['class' => 'prev disabled', 'tag' => 'li', 'disabledTag' => 'a']) ?>
    <?= $this->Paginator->numbers(['separator' => '', 'tag' => 'li', 'currentTag' => 'a']); ?>
    <?= $this->Paginator->next('›', ['tag' => 'li'], null,
        ['class' => 'next disabled', 'tag' => 'li', 'disabledTag' => 'a']); ?>
    <?= $this->Paginator->last('»', ['class' => 'last', 'tag' => 'li']); ?>
</ul>