var AceCodeBlocks = {

	// mode translation
	// (some modes have different names in ace/prism)
	getMode: function(mode) {
		if (mode === 'bash') {
			return 'sh';
		}
		else if (mode === 'markup') {
			return 'html';
		}
		else {
			return mode;
		}
	},

	init: function(inputId, switchId, mode, theme, useTabs, tabSize)
	{

		// Set input variable and hide it
		var input  = $("#" + inputId);
		input.hide();

		// Initialize Ace Editor
		ace.require("ace/ext/language_tools");
		var editor = ace.edit(inputId + "Container");

		// Configure Ace Editor
		editor.setTheme("ace/theme/" + theme);
		editor.getSession().setMode("ace/mode/" + this.getMode(mode));
		editor.setShowInvisibles(true);

		// Enable auto completion and snippets
		editor.setOptions({
			enableBasicAutocompletion: true,
			enableSnippets: true
		});

		// Are we using tabs? If so set the tab size
		if (useTabs === 1) {
			editor.getSession().setUseSoftTabs(false);
			editor.getSession().setTabSize(tabSize);
		}

		// Update Ace Editor with content from input
		editor.getSession().setValue(input.val());

		// Update input with content from Ace Editor
		editor.getSession().on('change', function(){
			input.val( editor.getSession().getValue() )
		});

		this.initSwitchMode(inputId, switchId);

	},

	initSwitchMode: function(inputId, switchId)
	{
		var that = this,
			$mode_switch = $('#'+switchId);

		$mode_switch.on('change', function() {
			that.switchMode(inputId, $mode_switch.val());
		});
	},

	switchMode: function(inputId, mode)
	{

		// Set input variable and hide it
		var input  = $("#" + inputId);
		var editor = ace.edit(inputId + "Container");

		// Configure Ace Editor
		editor.getSession().setMode("ace/mode/" + this.getMode(mode));
	}

};
