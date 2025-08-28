  <div class="page-content">     
    <div id="portlet-config" class="modal hide">
      <div class="modal-header">
        <button data-dismiss="modal" class="close" type="button"></button>
        <h3>Widget Settings</h3>
      </div>
      <div class="modal-body"> Widget settings form goes here </div>
    </div>
    <div class="clearfix"></div>

    <div class="content">  
      <ul class="breadcrumb">
        <li> <p>YOU ARE HERE</p> </li>
        <li><a href="#" class="active">Form layouts & Validations</a> </li>
      </ul>

    <div class="page-title"> <i class="icon-custom-left"></i>
        <h3>Form - <span class="semi-bold">Validations</span></h3>
      </div> 

      <div class="row">
         <div class="col-md-6">
            <div class="grid simple horizontal">
               <div class="grid-title">
                <h4>Traditional <span class="semi-bold">Validation</span></h4>
                <div class="tools">
                  <button type="button" class="btn btn-primary btn-xs btn-mini">Mini button</button>
                  <button type="button" class="btn btn-success btn-xs btn-mini">Mini button</button>
                </div>

                  <!--  <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div> -->
               </div>
               <div class="grid-body">
            <form id="form_traditional_validation" action="#">
                           
                     <div class="form-group">
                        <label class="form-label">Amount</label>
                        <span class="help">e.g. "5000"</span>
                <div class="input-with-icon  right">                                       
                  <i class=""></i>
                  <input type="text" name="form1Amount" id="form1Amount" class="form-control input-sm">
                </div>
                     </div>

                     <div class="form-group">
                        <label class="form-label">Card Holder's Name</label>
                        <span class="help">e.g. "Jane Smith"</span>
                <div class="input-with-icon  right">                                       
                  <i class=""></i>
                  <input type="text" name="form1CardHolderName" id="form1CardHolderName" class="form-control input-sm">
                </div>
                     </div>

                     <div class="form-group">
                        <label class="form-label">Card Number</label>
                        <span class="help">e.g. "5689569985"</span>
                <div class="input-with-icon  right">                                       
                  <i class=""></i>
                  <input type="text" name="form1CardNumber" id="form1CardNumber" class="form-control input-sm">
                </div>
                     </div>

                     <div class="row-fluid">
                        <div class="checkbox check-default">
                          <input id="checkbox1" type="checkbox" value="1">
                          <label for="checkbox1">Keep Me Signed in</label>
                        </div>
                    </div>

                    <div class="row-fluid">
                      <div class="checkbox check-success  ">
                        <input id="checkbox2" type="checkbox" value="1" checked="checked">
                        <label for="checkbox2">I agree</label>
                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="checkbox check-primary">
                        <input id="checkbox3" type="checkbox" value="1">
                        <label for="checkbox3">Mark</label>
                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="checkbox check-info">
                        <input id="checkbox4" type="checkbox" value="1">
                        <label for="checkbox4">Steve Jobs </label>
                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="checkbox check-warning">
                        <input id="checkbox5" type="checkbox" value="1" checked="checked">
                        <label for="checkbox5">Action</label>
                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="checkbox check-danger">
                        <input id="checkbox6" type="checkbox" value="1" checked="checked">
                        <label for="checkbox6">Mark as read</label>
                      </div>
                    </div>

                    <h3>Checkbox <span class="semi-bold">Options</span></h3>
                    <div class="row-fluid">
                      <div class="checkbox check-default checkbox-circle">
                        <input id="checkbox7" type="checkbox" value="1" checked="checked">
                        <label for="checkbox7">Keep Me Signed in</label>
                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="checkbox check-success checkbox-circle">
                        <input id="checkbox8" type="checkbox" value="1" >
                        <label for="checkbox8">I agree</label>
                      </div>
                    </div>
                    <div class="row-fluid">
                      <div class="checkbox check-primary checkbox-circle" >
                        <input id="checkbox9" type="checkbox" value="1" checked="checked">
                        <label for="checkbox9">Mark</label>
                      </div>
                    </div>


                    <h3>Simple <span class="semi-bold">dropdowns</span></h3>
                      <br>
                      <select id="source" style="width:100%">
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

                   <h3>Simple  Date<span class="semi-bold"> Picker</span></h3>

                    <br>
                    <div class="input-append success date col-md-10 col-lg-6 no-padding">
                      <input type="text" class="form-control">
                      <span class="add-on"><span class="arrow"></span><i class="fa fa-th"></i></span> </div>
                      <div class="clearfix"></div>


                <div class="form-actions">  
                <div class="pull-right">
                  <button type="submit" class="btn btn-success btn-cons"><i class="icon-ok"></i> Save</button>
                  <button type="button" class="btn btn-white btn-cons">Cancel</button>
                </div>
              </div>
            </form>
                </div>  <!-- END GRID BODY -->              
              </div> <!-- END GRID -->
            </div>

<div class="row-fluid">
        <div class="span12">
          <div class="grid simple ">
            <div class="grid-title">
              <h4>Table <span class="semi-bold">Styles</span></h4>
              <div class="tools"> <a href="javascript:;" class="collapse"></a> <a href="#grid-config" data-toggle="modal" class="config"></a> <a href="javascript:;" class="reload"></a> <a href="javascript:;" class="remove"></a> </div>
            </div>
            <div class="grid-body ">
              <table class="table table-hover table-condensed" id="example">
                <thead>
                  <tr>
                    <th style="width:1%"><div class="checkbox check-default" style="margin-right:auto;margin-left:auto;">
                        <input type="checkbox" value="1" id="checkbox1">
                        <label for="checkbox1"></label>
                      </div></th>
                    <th style="width:10%">Project Name</th>
                    <th style="width:22%" data-hide="phone,tablet">Description</th>
                    <th style="width:6%">Price</th>
                    <th style="width:10%" data-hide="phone,tablet">Progress</th>
                  </tr>
                </thead>
                <tbody>
                  <tr >
                    <td class="v-align-middle"><div class="checkbox check-default">
                        <input type="checkbox" value="3" id="checkbox2">
                        <label for="checkbox2"></label>
                      </div></td>
                    <td class="v-align-middle">Early Bird</td>
                    <td class="v-align-middle"><span class="muted">Redesign project template</span></td>
                    <td><span class="muted">$4,500</span></td>
                    <td class="v-align-middle"><div class="progress ">
                        <div data-percentage="80%"  class="progress-bar progress-bar-success animate-progress-bar"></div>
                      </div></td>
                  </tr>
                  <tr>
                    <td><div class="checkbox check-default">
                        <input type="checkbox" value="3" id="checkbox3">
                        <label for="checkbox3"></label>
                      </div></td>
                    <td>Angry Birds&nbsp;&nbsp;&nbsp;<span class="label label-important">ALERT!</span></td>
                    <td><span class="muted">Something goes here</span></td>
                    <td><span class="muted">$9,000</span></td>
                    <td><div class="progress">
                        <div data-percentage="70%"  class="progress-bar progress-bar-danger animate-progress-bar"></div>
                      </div></td>
                  </tr>
                  <tr>
                    <td><div class="checkbox check-default">
                        <input type="checkbox" value="3" id="checkbox4">
                        <label for="checkbox4"></label>
                      </div></td>
                    <td>PHP Login page</td>
                    <td class="v-align-middle"><span class="muted">A project in business and science is typically defined</span></td>
                    <td><span class="muted">$5,400</span></td>
                    <td><div class="progress progress-info">
                        <div data-percentage="60%"  class="progress-bar progress-bar-primary animate-progress-bar"></div>
                      </div></td>
                  </tr>
                  <tr>
                    <td><div class="checkbox check-default">
                        <input type="checkbox" value="3" id="checkbox5">
                        <label for="checkbox5"></label>
                      </div></td>
                    <td>Zombies</td>
                    <td class="v-align-middle"><span class="muted">frequently involving research or design</span></td>
                    <td><span class="muted">$6,000</span></td>
                    <td><div class="progress">
                        <div data-percentage="60%"  class="progress-bar progress-bar-warning animate-progress-bar"></div>
                      </div></td>
                  </tr>
                  <tr>
                    <td><div class="checkbox check-default">
                        <input type="checkbox" value="3" id="checkbox6">
                        <label for="checkbox6"></label>
                      </div></td>
                    <td>Zombies</td>
                    <td class="v-align-middle"><span class="muted">frequently involving research or design</span></td>
                    <td><span class="muted">$6,000</span></td>
                    <td><div class="progress ">
                        <div data-percentage="42%" class="progress-bar progress-bar-warning animate-progress-bar"></div>
                      </div></td>
                  </tr>
                  <tr>
                    <td><div class="checkbox check-default">
                        <input type="checkbox" value="3" id="checkbox20">
                        <label for="checkbox20"></label>
                      </div></td>
                    <td>Zombies</td>
                    <td class="v-align-middle"><span class="muted">frequently involving research or design</span></td>
                    <td><span class="muted">$6,000</span></td>
                    <td><div class="progress progress-warning">
                        <div data-percentage="42%"  class="progress-bar progress-bar-warning animate-progress-bar"></div>
                      </div></td>
                  </tr>
                  <tr>
                    <td><div class="checkbox check-default">
                        <input type="checkbox" value="3" id="checkbox7">
                        <label for="checkbox7"></label>
                      </div></td>
                    <td>Zombies</td>
                    <td class="v-align-middle"><span class="muted">frequently involving research or design</span></td>
                    <td><span class="muted">$6,000</span></td>
                    <td><div class="progress ">
                        <div data-percentage="42%" class="progress-bar progress-bar-warning animate-progress-bar"></div>
                      </div></td>
                  </tr>
                  <tr>
                    <td><div class="checkbox check-default">
                        <input type="checkbox" value="3" id="checkbox8">
                        <label for="checkbox8"></label>
                      </div></td>
                    <td>Zombies</td>
                    <td class="v-align-middle"><span class="muted">frequently involving research or design</span></td>
                    <td><span class="muted">$6,000</span></td>
                    <td><div class="progress ">
                        <div data-percentage="42%" class="progress-bar progress-bar-warning animate-progress-bar"></div>
                      </div></td>
                  </tr>
                  <tr>
                    <td><div class="checkbox check-default">
                        <input type="checkbox" value="3" id="checkbox9">
                        <label for="checkbox9"></label>
                      </div></td>
                    <td>Zombies</td>
                    <td class="v-align-middle"><span class="muted">frequently involving research or design</span></td>
                    <td><span class="muted">$6,000</span></td>
                    <td><div class="progress ">
                        <div data-percentage="42%" class="progress-bar progress-bar-warning animate-progress-bar"></div>
                      </div></td>
                  </tr>
                  <tr>
                    <td><div class="checkbox check-default">
                        <input type="checkbox" value="3" id="checkbox10">
                        <label for="checkbox10"></label>
                      </div></td>
                    <td>Zombies</td>
                    <td class="v-align-middle"><span class="muted">frequently involving research or design</span></td>
                    <td><span class="muted">$6,000</span></td>
                    <td><div class="progress ">
                        <div data-percentage="42%" class="progress-bar progress-bar-warning animate-progress-bar"></div>
                      </div></td>
                  </tr>
                  <tr>
                    <td><div class="checkbox check-default">
                        <input type="checkbox" value="3" id="checkbox11">
                        <label for="checkbox11"></label>
                      </div></td>
                    <td>Zombies</td>
                    <td class="v-align-middle"><span class="muted">frequently involving research or design</span></td>
                    <td><span class="muted">$6,000</span></td>
                    <td><div class="progress ">
                        <div data-percentage="42%" class="progress-bar progress-bar-warning animate-progress-bar"></div>
                      </div></td>
                  </tr>
                  <tr>
                    <td><div class="checkbox check-default">
                        <input type="checkbox" value="3" id="checkbox12">
                        <label for="checkbox12"></label>
                      </div></td>
                    <td>Zombies</td>
                    <td class="v-align-middle"><span class="muted">frequently involving research or design</span></td>
                    <td><span class="muted">$6,000</span></td>
                    <td><div class="progress ">
                        <div data-percentage="42%" class="progress-bar progress-bar-warning animate-progress-bar"></div>
                      </div></td>
                  </tr>
                  <tr>
                    <td><div class="checkbox check-default">
                        <input type="checkbox" value="3" id="checkbox13">
                        <label for="checkbox13"></label>
                      </div></td>
                    <td>Zombies</td>
                    <td class="v-align-middle"><span class="muted">frequently involving research or design</span></td>
                    <td><span class="muted">$6,000</span></td>
                    <td><div class="progress ">
                        <div data-percentage="42%" class="progress-bar progress-bar-warning animate-progress-bar"></div>
                      </div></td>
                  </tr>
                  <tr>
                    <td><div class="checkbox check-default">
                        <input type="checkbox" value="3" id="checkbox14">
                        <label for="checkbox14"></label>
                      </div></td>
                    <td>Zombies</td>
                    <td class="v-align-middle"><span class="muted">frequently involving research or design</span></td>
                    <td><span class="muted">$6,000</span></td>
                    <td><div class="progress ">
                        <div data-percentage="42%" class="progress-bar progress-bar-warning animate-progress-bar"></div>
                      </div></td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>


      </div> <!-- END ROW -->

    </div>
  </div>