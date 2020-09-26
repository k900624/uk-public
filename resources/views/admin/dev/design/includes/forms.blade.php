<div class="col-md-12">
    <div class="row">
        <div class="col-md-7">
            <section class="block">
                <header class="block_header">
                    <h3>Forms</h3>
                </header>
                <div class="block_body">
                    <div class="well">

                        <form class="form-horizontal">
                            <fieldset>
                                <legend>Legend</legend>
                                <div class="form-group bs-component">
                                    <label for="inputEmail" class="col-lg-2 control-label">Email</label>
                                    <div class="col-lg-10">
                                        <input type="text" class="form-control" id="inputEmail" placeholder="Email">
                                    </div>
                                </div>
                                <div class="form-group bs-component">
                                    <label for="inputPassword" class="col-lg-2 control-label">Password</label>
                                    <div class="col-lg-10">
                                        <input type="password" class="form-control" id="inputPassword" placeholder="Password">
                                        <div class="checkbox">
                                            <label>
                                                <input type="checkbox"> Checkbox
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group bs-component">
                                    <label for="inputPassword" class="col-lg-2 control-label">Fancy checkbox</label>
                                    <div class="col-lg-10">
                                        <div class="material-switch">
                                            <input name="check" id="fancyCheck" type="checkbox" value="0">
                                            <label for="fancyCheck" class="label-success"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group bs-component">
                                    <label for="inputPassword" class="col-lg-2 control-label">Fancy checkbox checked</label>
                                    <div class="col-lg-10">
                                        <div class="material-switch">
                                            <input name="check" id="fancyChecked" type="checkbox" value="1" checked="checked">
                                            <label for="fancyChecked" class="label-success"></label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group bs-component">
                                    <label for="textArea" class="col-lg-2 control-label">Textarea</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" rows="3" id="textArea"></textarea>
                                        <span class="help-block">A longer block of help text that breaks onto a new line and may extend beyond one line.</span>
                                    </div>
                                </div>
                                <div class="form-group bs-component">
                                    <label class="col-lg-2 control-label">Radios</label>
                                    <div class="col-lg-10">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
                                                Option one is this
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
                                                Option two can be something else
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group bs-component">
                                    <label for="select" class="col-lg-2 control-label">Selects</label>
                                    <div class="col-lg-10">
                                        <select class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                        <br>
                                        <select multiple="" class="form-control">
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>5</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="reset" class="btn btn-default">Cancel</button>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </fieldset>
                        </form>
                        
                    </div>
                </div>
            </section>
        </div>
        <div class="col-md-5">
            <section class="block">
                <header class="block_header">
                    <h3>Forms classes</h3>
                </header>
                <div class="block_body">

                    <form>
                        <div class="form-group bs-component">
                            <label class="control-label" for="focusedInput">Focused input</label>
                            <input class="form-control focused" id="focusedInput" type="text" value="This is focused...">
                        </div>

                        <div class="form-group bs-component">
                            <label class="control-label" for="disabledInput">Disabled input</label>
                            <input class="form-control" id="disabledInput" type="text" placeholder="Disabled input here..." disabled="">
                        </div>

                        <div class="form-group bs-component">
                            <label class="control-label" for="inputWarning">Input warning</label>
                            <input type="text" class="form-control warning" id="inputWarning">
                            <label for="inputWarning" class="warning">Это поле обязательно для заполнения.</label>
                        </div>

                        <div class="form-group bs-component">
                            <label class="control-label" for="inputError">Input error</label>
                            <input type="text" class="form-control error" id="inputError">
                            <label for="inputError" class="error">Это поле обязательно для заполнения.</label>
                        </div>

                        <div class="form-group bs-component">
                            <label class="control-label" for="inputSuccess">Input success</label>
                            <input type="text" class="form-control valid" id="inputSuccess">
                        </div>

                        <div class="form-group bs-component">
                            <label class="control-label" for="inputLarge">Large input</label>
                            <input class="form-control input-lg" type="text" id="inputLarge">
                        </div>

                        <div class="form-group bs-component">
                            <label class="control-label" for="inputDefault">Default input</label>
                            <input type="text" class="form-control" id="inputDefault">
                        </div>

                        <div class="form-group bs-component">
                            <label class="control-label" for="inputSmall">Small input</label>
                            <input class="form-control input-sm" type="text" id="inputSmall">
                        </div>

                        <div class="form-group bs-component">
                            <label class="control-label">Input addons</label>
                            <div class="input-group">
                                <span class="input-group-addon">$</span>
                                <input type="text" class="form-control">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button">Button</button>
                                </span>
                            </div>
                        </div>
                    </form>

                </div>
                </section>
            </div>

            <div class="col-md-12">
                <section class="block">
                    <header class="block_header">
                        <h3>Select2 <small>jQuery based replacement for select boxes</small></h3>
                    </header>
                    <div class="block_body">

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="lead">Basics<small class="text-muted">Single select boxes</small></p>
                                    <select class="form-control" id="select2-1">
                                        <option value="AL" data-select2-id="2">Alabama</option>
                                        <option value="AR">Arkansas</option>
                                        <option value="IL">Illinois</option>
                                        <option value="IA">Iowa</option>
                                        <option value="KS">Kansas</option>
                                        <option value="KY">Kentucky</option>
                                        <option value="LA">Louisiana</option>
                                        <option value="MN">Minnesota</option>
                                        <option value="MS">Mississippi</option>
                                        <option value="MO">Missouri</option>
                                        <option value="OK">Oklahoma</option>
                                        <option value="SD">South Dakota</option>
                                        <option value="TX">Texas</option>
                                        <option value="TN">Tennessee</option>
                                        <option value="WI">Wisconsin</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="lead">Multiple<small class="text-muted">Select2 also supports multi-value select boxes. The select below is declared with the multiple attribute.</small></p>
                                    <select class="form-control" id="select2-2" multiple="">
                                        <optgroup label="Alaskan/Hawaiian Time Zone">
                                            <option value="AK">Alaska</option>
                                            <option value="HI">Hawaii</option>
                                        </optgroup>
                                        <optgroup label="Pacific Time Zone">
                                            <option value="CA">California</option>
                                            <option value="NV">Nevada</option>
                                            <option value="OR">Oregon</option>
                                            <option value="WA">Washington</option>
                                        </optgroup>
                                        <optgroup label="Mountain Time Zone">
                                            <option value="AZ">Arizona</option>
                                            <option value="CO">Colorado</option>
                                            <option value="ID">Idaho</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="UT">Utah</option>
                                            <option value="WY">Wyoming</option>
                                        </optgroup>
                                        <optgroup label="Central Time Zone">
                                            <option value="AL">Alabama</option>
                                            <option value="AR">Arkansas</option>
                                            <option value="IL">Illinois</option>
                                            <option value="IA">Iowa</option>
                                            <option value="KS">Kansas</option>
                                            <option value="KY">Kentucky</option>
                                            <option value="LA">Louisiana</option>
                                            <option value="MN">Minnesota</option>
                                            <option value="MS">Mississippi</option>
                                            <option value="MO">Missouri</option>
                                            <option value="OK">Oklahoma</option>
                                            <option value="SD">South Dakota</option>
                                            <option value="TX">Texas</option>
                                            <option value="TN">Tennessee</option>
                                            <option value="WI">Wisconsin</option>
                                        </optgroup>
                                        <optgroup label="Eastern Time Zone">
                                            <option value="CT">Connecticut</option>
                                            <option value="DE">Delaware</option>
                                            <option value="FL">Florida</option>
                                            <option value="GA">Georgia</option>
                                            <option value="IN">Indiana</option>
                                            <option value="ME">Maine</option>
                                            <option value="MD">Maryland</option>
                                            <option value="MA">Massachusetts</option>
                                            <option value="MI">Michigan</option>
                                            <option value="NH">New Hampshire</option>
                                            <option value="NJ">New Jersey</option>
                                            <option value="NY">New York</option>
                                            <option value="NC">North Carolina</option>
                                            <option value="OH">Ohio</option>
                                            <option value="PA">Pennsylvania</option>
                                            <option value="RI">Rhode Island</option>
                                            <option value="SC">South Carolina</option>
                                            <option value="VT">Vermont</option>
                                            <option value="VA">Virginia</option>
                                            <option value="WV">West Virginia</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="lead">Placeholders<small class="text-muted">A placeholder value can be defined and will be displayed until a selection is made. Select2 uses the placeholder attribute on multiple select boxes, which requires IE 10+. You can support it in older versions with the Placeholders.js polyfill.</small></p>
                                    <select class="form-control" id="select2-3">
                                        <optgroup label="Alaskan/Hawaiian Time Zone">
                                            <option value="AK" data-select2-id="5">Alaska</option>
                                            <option value="HI">Hawaii</option>
                                        </optgroup>
                                        <optgroup label="Pacific Time Zone">
                                            <option value="CA">California</option>
                                            <option value="NV">Nevada</option>
                                            <option value="OR">Oregon</option>
                                            <option value="WA">Washington</option>
                                        </optgroup>
                                        <optgroup label="Mountain Time Zone">
                                            <option value="AZ">Arizona</option>
                                            <option value="CO">Colorado</option>
                                            <option value="ID">Idaho</option>
                                            <option value="MT">Montana</option>
                                            <option value="NE">Nebraska</option>
                                            <option value="NM">New Mexico</option>
                                            <option value="ND">North Dakota</option>
                                            <option value="UT">Utah</option>
                                            <option value="WY">Wyoming</option>
                                        </optgroup>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <p class="lead">Loading array data<small class="text-muted">Select2 provides a way to load the data from a local array.</small></p>
                                    <select class="form-control" id="select2-4"></select>
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
            </div>

            <div class="col-md-12">
                <section class="block">
                    <header class="block_header">
                        <h3>MultiSelect <small>A user-friendlier drop-in replacement for the standard &lt;select&gt; with 'multiple' attribute activated.</small></h3>
                    </header>
                    <div class="block_body">
                        <div class="row">
                            <div class="col-md-6 mb-20">
                                <p class="lead">Pre-selected options</p>
                                <select id="multiselect1" multiple="">
                                    <option value="elem_1" selected="">elem 1</option>
                                    <option value="elem_2" selected="" disabled="">elem 2</option>
                                    <option value="elem_3">elem 3</option>
                                    <option value="elem_4">elem 4</option>
                                    <option value="elem_5">elem 5</option>
                                    <option value="elem_6">elem 6</option>
                                    <option value="elem_7">elem 7</option>
                                    <option value="elem_8">elem 8</option>
                                    <option value="elem_9">elem 9</option>
                                    <option value="elem_10">elem 10</option>
                                    <option value="elem_11">elem 11</option>
                                    <option value="elem_12">elem 12</option>
                                    <option value="elem_13">elem 13</option>
                                    <option value="elem_14">elem 14</option>
                                    <option value="elem_15">elem 15</option>
                                    <option value="elem_16">elem 16</option>
                                    <option value="elem_17">elem 17</option>
                                    <option value="elem_18">elem 18</option>
                                    <option value="elem_19">elem 19</option>
                                    <option value="elem_20">elem 20</option>
                                </select>
                            </div>

                            <div class="col-md-6 mb-20">
                             <p class="lead">Optgroup</p>
                                <select id="optgroup" multiple="multiple">
                                    <optgroup label="Friends">
                                        <option value="1">Yoda</option>
                                        <option value="2" selected="">Obiwan</option>
                                    </optgroup>
                                    <optgroup label="Enemies">
                                        <option value="3">Palpatine</option>
                                        <option value="4" disabled="">Darth Vader</option>
                                    </optgroup>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <p class="lead">Public methods</p>
                                <div class="mb-10">
                                    <select id="public-methods" multiple="multiple">
                                        <option value="elem_1">elem 1</option>
                                        <option value="elem_2" disabled="">elem 2</option>
                                        <option value="elem_3">elem 3</option>
                                        <option value="elem_4">elem 4</option>
                                        <option value="elem_5">elem 5</option>
                                        <option value="elem_6">elem 6</option>
                                        <option value="elem_7">elem 7</option>
                                        <option value="elem_8">elem 8</option>
                                        <option value="elem_9">elem 9</option>
                                        <option value="elem_10">elem 10</option>
                                        <option value="elem_11">elem 11</option>
                                        <option value="elem_12">elem 12</option>
                                        <option value="elem_13">elem 13</option>
                                        <option value="elem_14">elem 14</option>
                                        <option value="elem_15">elem 15</option>
                                        <option value="elem_16">elem 16</option>
                                        <option value="elem_17">elem 17</option>
                                        <option value="elem_18">elem 18</option>
                                        <option value="elem_19">elem 19</option>
                                        <option value="elem_20">elem 20</option>
                                    </select>
                                </div>
                                <button class="btn btn-secondary btn-sm" id="select-all">Select All</button>
                                <button class="btn btn-secondary btn-sm" id="deselect-all">Deselect All</button>
                                <button class="btn btn-secondary btn-sm" id="select-100">Select 10 Items</button>
                                <button class="btn btn-secondary btn-sm" id="deselect-100">Deselect 10 Items</button>
                            </div>

                            <div class="col-md-6">
                                <p class="lead">Custom Header and Footer</p>
                                <select id="ms-custom" multiple="">
                                    <option value="elem_1" selected="">elem 1</option>
                                    <option value="elem_2" selected="" disabled="">elem 2</option>
                                    <option value="elem_3">elem 3</option>
                                    <option value="elem_4">elem 4</option>
                                    <option value="elem_5">elem 5</option>
                                    <option value="elem_6">elem 6</option>
                                    <option value="elem_7">elem 7</option>
                                    <option value="elem_8">elem 8</option>
                                    <option value="elem_9">elem 9</option>
                                    <option value="elem_10">elem 10</option>
                                    <option value="elem_11">elem 11</option>
                                    <option value="elem_12">elem 12</option>
                                    <option value="elem_13">elem 13</option>
                                    <option value="elem_14">elem 14</option>
                                    <option value="elem_15">elem 15</option>
                                    <option value="elem_16">elem 16</option>
                                    <option value="elem_17">elem 17</option>
                                    <option value="elem_18">elem 18</option>
                                    <option value="elem_19">elem 19</option>
                                    <option value="elem_20">elem 20</option>
                                </select>
                            </div>
                        </div>

                    </div>
                </section>
            </div>

            <div class="col-md-12">
                <section class="block">
                    <header class="block_header">
                        <h3>Range Sliders <small>noUiSlider is a free and lightweight JavaScript range slider with full touch support</small></h3>
                    </header>
                    <div class="block_body">

                        <p class="lead mb-0">Single</p>
                        <div class="ui-slider mb-20 noUi-target noUi-ltr noUi-horizontal" data-start="40"></div>

                        <p class="lead mb-0 mt-10">Range</p>
                        <div class="ui-slider-range mb-20 noUi-target noUi-ltr noUi-horizontal"></div>

                        <p class="mt-10 mb-0 clearfix"><span class="lead mb-0 pull-left">Live values</span><span class="pull-right"><strong class="text-muted" id="ui-slider-value-lower">35.00</strong><span class="text-muted"> - </span><strong class="text-muted" id="ui-slider-value-upper">75.00</strong></span></p>
                        <div class="ui-slider-values mb-20 noUi-target noUi-ltr noUi-horizontal"></div>

                        <p class="lead mb-0 mt-10">Slider Success</p>
                        <div class="ui-slider-range mb-20 ui-slider-success noUi-target noUi-ltr noUi-horizontal"></div>

                        <p class="lead mb-0 mt-10">Slider Info</p>
                        <div class="ui-slider-range mb-20 ui-slider-info noUi-target noUi-ltr noUi-horizontal"></div>

                        <p class="lead mb-0 mt-10">Slider Warning</p>
                        <div class="ui-slider-range mb-20 ui-slider-warning noUi-target noUi-ltr noUi-horizontal"></div>

                        <p class="lead mb-0 mt-10">Slider Danger</p>
                        <div class="ui-slider-range mb-20 ui-slider-danger noUi-target noUi-ltr noUi-horizontal"></div>

                    </div>
                </section>
            </div>
            
        </div>
    </section>
</div>