<script type="text/javascript" src="/js/jquery.inputmask.min.js" charset="utf-8"></script>

    $(".phone-mask").inputmask({
		"mask": "+1 (999) 999-9999",
		"removeMaskOnSubmit": true,
		"oncomplete": function(){  },
		"onincomplete": function(){ },
		'autoUnmask': true
	});
