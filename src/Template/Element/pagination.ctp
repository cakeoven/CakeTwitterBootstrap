<ul class="pagination pagination-sm">
	<?php echo $this->Paginator->first('«', array('class' => 'first', 'tag' => 'li'))?>
	<?php echo $this->Paginator->prev('‹', array('tag' => 'li'), null, array('class' => 'prev disabled', 'tag' => 'li', 'disabledTag' => 'a'))?>
	<?php echo $this->Paginator->numbers(array('separator' => '', 'tag' => 'li', 'currentTag' => 'a'));?>
	<?php echo $this->Paginator->next('›', array('tag' => 'li'), null, array('class' => 'next disabled', 'tag' => 'li', 'disabledTag' => 'a'));?>
	<?php echo $this->Paginator->last('»', array('class' => 'last', 'tag' => 'li'));?>
</ul>