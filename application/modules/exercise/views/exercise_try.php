
        <script src="<?=base_url();?>assets/admin/ckeditor4/ckeditor.js"></script>
    <div name="editor_question" id="editor_question">
        <p>In elementary algebra, the <b>quadratic formula</b> is the solution of the quadratic equation.</p>

        <p style="text-align: center;">
        <math xmlns="http://www.w3.org/1998/Math/MathML"><mi>x</mi><mo>=</mo><mfrac><mrow><mo>-</mo><mi>b</mi><mo>±</mo><msqrt><msup><mi>b</mi><mn>2</mn></msup><mo>-</mo><mn>4</mn><mi>a</mi><mi>c</mi></msqrt></mrow><mrow><mn>2</mn><mi>a</mi></mrow></mfrac></math>
        </p>

        <p><b>Water is made from two molecules</b> - Hydrogen and Oxygen. If you put the two gasses together, along with energy, you can make water.</p>

        <p style="text-align: center;">
        <math class="wrs_chemistry" xmlns="http://www.w3.org/1998/Math/MathML"><msub><mi mathvariant="normal">H</mi><mn>2</mn></msub><mfenced><mi mathvariant="normal">g</mi></mfenced><mo>+</mo><msub><mi mathvariant="normal">O</mi><mn>2</mn></msub><mfenced><mi mathvariant="normal">g</mi></mfenced><mo>⇌</mo><mn>2</mn><msub><mi mathvariant="normal">H</mi><mn>2</mn></msub><mi mathvariant="normal">O</mi><mfenced><mi mathvariant="normal">l</mi></mfenced></math>
        </p>

        <p>The entire formula for the surface area of a cylinder is
        <math xmlns="http://www.w3.org/1998/Math/MathML"><mn>2</mn><msup><mi>πr</mi><mn>2</mn></msup><mo>+</mo><mn>2</mn><mi>πrh</mi></math>
        </p>
    </div>




<script>
    CKEDITOR.config.toolbar_Full =
        [
        { name: 'document', items : [ 'Source'] },
        { name: 'clipboard', items : [ 'Cut','Copy','Paste','-','Undo','Redo' ] },
        { name: 'editing', items : [ 'Find'] },
        { name: 'basicstyles', items : [ 'Bold','Italic','Underline'] },
        { name: 'paragraph', items : [ 'JustifyLeft','JustifyCenter','JustifyRight'] }
        ];
    CKEDITOR.config.height = '40px';
    CKEDITOR.plugins.addExternal('divarea', '<?=base_url();?>assets/admin/ckeditor4/extraplugins/divarea/', 'plugin.js');
    CKEDITOR.config.removePlugins = 'maximize';
    CKEDITOR.config.removePlugins = 'resize';
    CKEDITOR.replace('editor_question', {
         extraPlugins: 'divarea,ckeditor_wiris',
         language: 'en'
    });
</script>
 