// Requires Javascript
var setup_code = "";

$(document).ready(function(event) {

  // Calculate line numbers
  var line_count = 0;
  $('aside.code pre code#setup.language-javascript').each(function() {
    line_count = $(this).text().split("\n").length + 1
    setup_code = $(this).text();
  });


  var language = "";
  if ($('aside.code pre code.language-javascript').length > 0) {
    language = "javascript";
  } else if ($('aside.code pre code.language-php').length > 0) {
    language = "php";
  }

  var no_setup = false;
  if (setup_code == "") {
    no_setup = true;
    if (language == "javascript") {
      setup_code = ['// Setup settings',
                    'var ChaosSettings = {',
                    '  "servicePath":"http://api.chaos-systems.com/",',
                    '  //"clientGUID":"9f62060c-64ff-e14f-a8d5-d85a1e2e21b8",',
                    '  "accessPointGUID":"C4C2B8DA-A980-11E1-814B-02CEA2621172",',
                    '};',
                    '// Instantiate client',
                    'var client = new PortalClient(',
                    '                   ChaosSettings.servicePath,',
                    '                   ChaosSettings.clientGUID',
                    ');'].join('\n');
    } else if (language == "php") {
      setup_code = ['&lt;?php',
                    'set_include_path(get_include_path() . PATH_SEPARATOR . __DIR__ .',
                    '                 "/../src"); // &lt;-- Relative path to Portal Client',
                    '',
                    'require_once("CaseSensitiveAutoload.php");',
                    '',
                    'spl_autoload_extensions(".php");',
                    'spl_autoload_register("CaseSensitiveAutoload");',
                    '',
                    'use CHAOS\\Portal\\Client\\PortalClient;',
                    '',
                    '$servicePath = "http://api.chaos-systems.com/";',
                    '$clientGUID = "B9CBFFDD-3F73-48FC-9D5D-3802FBAD4CBD";',
                    '$accessPointGUID = "C4C2B8DA-A980-11E1-814B-02CEA2621172";',
                    '',
                    '$client = new PortalClient($servicePath, $clientGUID);',
                    '',
                    'echo "SessionGUID: " . $client-&gt;SessionGUID() . "<br />";',
                    '?&gt;'].join('\n');
    }
    line_count = setup_code.split("\n").length + 1;
  }

  $('aside.code pre code').each(function() {
    var pre = $(this).parent();
    var code = $(this).html();
    var aside = pre.parent();

    // http://codemirror.net/doc/manual.html#api_configuration
    var CodeMirrorSettings = {
      value: code,
      lineNumbers: true,
      tabSize: 2,
    };

    // Save the <code> element
    codeElem = $(this).clone();

    // Make CodeMirror
    var textarea = $('<textarea>' + code + '</textarea>');
    pre.replaceWith(textarea);
    // var textarea = aside.children('textarea').get(0);
    var codeMirror = CodeMirror.fromTextArea(textarea.get(0), CodeMirrorSettings);
    aside.attr('id', codeElem.attr('id'));
    aside.data('codeMirror', codeMirror);

    // Setup CodeMirror
    if (codeElem.hasClass('language-html')) {
      codeMirror.setOption('mode', 'htmlmixed');
    } else if (codeElem.hasClass('language-php')) {
      codeMirror.setOption('mode', 'php');

      if (no_setup) {
        codeMirror.setOption('firstLineNumber', line_count);
      }

    } else if (codeElem.hasClass('language-xml')) {
      codeMirror.setOption('mode', 'xml');
      // BEGIN WORKS
      // CodeMirror.commands["selectAll"](codeMirror);
      // function getSelectedRange() {
      //   return { from: codeMirror.getCursor(true), to: codeMirror.getCursor(false) };
      // }
      // var range = getSelectedRange();
      // alert(JSON.stringify(range.from));
      // alert(JSON.stringify(range.to));
      // codeMirror.autoFormatRange(range.from, range.to);
      // END WORKS
      // var range = getSelectedRange();
      // {line, ch}
      codeMirror.autoFormatRange({'line': 0, 'ch': 0}, {'line': 1, 'ch': 0});
      codeMirror.setSelection({'line': 0, 'ch': 0})
      codeMirror.refresh();
      // codeMirror.autoIndentRange(1, 2);
      // codeMirror.autoFormatRange(range.from, range.to); 
    } else if (codeElem.hasClass('language-json')) {
      codeMirror.setOption('mode', { 'name': 'javascript', 'json': true });
    } else if (codeElem.hasClass('language-javascript')) {
      codeMirror.setOption('mode', 'javascript');

      if (codeElem.hasClass("eval")) {
        codeMirror.setOption('firstLineNumber', line_count);

        // Add Javascript evaluate button
        var codeButton = $('<div class="try-code"><button>Try!<\/button><\/div>');
        codeButton.children('button').click(codeEval(codeMirror, setup_code));
        aside.append(codeButton);
      }
    }
  });

  var all_code = $('<div><textarea></textarea></div>');
  all_code.hide();

  var show_code_toggle = false;
  var show_code = $('<p>&#x25B6; Show all code on this page</p>');
  show_code.click(function(event) {

    if (show_code_toggle) {
      show_code.html('&#x25B6; Show all code on this page');
      all_code.hide();
    } else {
      show_code.html('&#x25BC; Hide');

      var code = "";
      if (no_setup) {
        code = setup_code;
      }
      $('aside.code').each(function() {
        if (!$(this).hasClass('result')) {
          code += $(this).data('codeMirror').getValue();
        }
      });

      all_code.find('textarea').html(code);
      // alert(JSON.stringify(all_code.find('textarea')));
      // alert(all_code.find('textarea').html());

      all_code.show();
    }

    show_code_toggle = !show_code_toggle;
  });
  $('body footer').before(show_code);
  $('body footer').before(all_code);

});

function codeEval(codeMirror, setup_code) {
  return function(event) {
    var code = codeMirror.getValue();

    // http://aaronrussell.co.uk/legacy/check-if-an-element-exists-using-jquery/
    if ($('#setup.code').length > 0) {
      setup_code = $('#setup.code').data('codeMirror').getValue();
    }

    // console.log(setup_code + code);
    eval(setup_code + code);
  };
}
