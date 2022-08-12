<div id="generator">
        
        <div id="config" style="display: none">
            <div class="config">
                <div class="title">Type</div>
                <input type="radio" name="btype" id="ean8" value="ean8" checked="checked"><label for="ean8">EAN 8</label><br />
                <input type="radio" name="btype" id="ean13" value="ean13"><label for="ean13">EAN 13</label><br />
                <input type="radio" name="btype" id="upc" value="upc"><label for="upc">UPC</label><br />
                <input type="radio" name="btype" id="std25" value="std25"><label for="std25">standard 2 of 5 (industrial)</label><br />
                <input type="radio" name="btype" id="int25" value="int25"><label for="int25">interleaved 2 of 5</label><br />
                <input type="radio" name="btype" id="code11" value="code11"><label for="code11">code 11</label><br />
                <input type="radio" name="btype" id="code39" value="code39"><label for="code39">code 39</label><br />
                <input type="radio" name="btype" id="code93" value="code93"><label for="code93">code 93</label><br />
                <input type="radio" name="btype" id="code128" value="code128" checked="checked"><label for="code128">code 128</label><br />
                <input type="radio" name="btype" id="codabar" value="codabar"><label for="codabar">codabar</label><br />
                <input type="radio" name="btype" id="msi" value="msi"><label for="msi">MSI</label><br />
                <input type="radio" name="btype" id="datamatrix" value="datamatrix"><label for="datamatrix">Data Matrix</label><br /><br />
            </div>

            <div class="config">
                <div class="title">Misc</div>
                Background : <input type="text" id="bgColor" value="#FFFFFF" size="7"><br /> "1" Bars : <input type="text" id="color" value="#000000" size="7"><br />
                <div class="barcode1D">
                    bar width: <input type="text" id="barWidth" value="1" size="3"><br /> bar height: <input type="text" id="barHeight" value="50" size="3"><br />
                </div>
                <div class="barcode2D">
                    Module Size: <input type="text" id="moduleSize" value="5" size="3"><br /> Quiet Zone Modules: <input type="text" id="quietZoneSize" value="1" size="3"><br /> Form: <input type="checkbox" name="rectangular" id="rectangular"><label for="rectangular">Rectangular</label><br
                    />
                </div>
                <div id="miscCanvas">
                    x : <input type="text" id="posX" value="10" size="3"><br /> y : <input type="text" id="posY" value="20" size="3"><br />
                </div>
            </div>

            <div class="config">
                <div class="title">Format</div>
                <input type="radio" id="css" name="renderer" value="css"><label for="css">CSS</label><br />
                <input type="radio" id="bmp" name="renderer" value="bmp"><label for="bmp">BMP (not usable in IE)</label><br />
                <input type="radio" id="svg" name="renderer" value="svg" checked="checked"><label for="svg">SVG (not usable in IE)</label><br />
                <input type="radio" id="canvas" name="renderer" value="canvas"><label for="canvas">Canvas (not usable in IE)</label><br />
            </div>
        </div>
       

    </div>