</div>

<div id="footer">&copy; Copyright <?=date('Y')?> visitortarget.com | <a href="#">Top</a></div>

</div><!--  end div #wconent_rapper -->
<!--  END CONTENT WRAPPER -->
</div>
<!--  END WRAPPER -->


<!-- JS rule for alphanumeric -->
<script language="javascript">
$('.noSpaces').alphanumeric();
$('.slug').alphanumeric({allow:'-_'});
$('.urlLink').alphanumeric({allow:'-_./'});
$('.numericOnly').numeric();
$('.emailOnly').alphanumeric({allow:'@-_.,'});
$('.dateOnly').numeric({allow:'-'});
</script>

</body>
</html>