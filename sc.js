		function allowAlphaNumericSpace(e) {
		  var code = ('charCode' in e) ? e.charCode : e.keyCode;
		  if (!(code == 32) && // space
			!(code > 47 && code < 58) && // numeric (0-9)
			!(code > 64 && code < 91) && // upper alpha (A-Z)
			!(code > 96 && code < 123)) { // lower alpha (a-z)
			e.preventDefault();
		  }
		}

		function allowHurufTok(e) {
		  var code = ('charCode' in e) ? e.charCode : e.keyCode;
		  if (!(code == 32) && // space
			!(code > 64 && code < 91) && // upper alpha (A-Z)
			!(code > 96 && code < 123)) { // lower alpha (a-z)
			e.preventDefault();
		  }
		}

		function allowAngkaTok(e) {
		  var code = ('charCode' in e) ? e.charCode : e.keyCode;
		  if (!(code == 32) && // space
			!(code > 47 && code < 58))
			{ // lower alpha (a-z)
			e.preventDefault();
		  }
		}
