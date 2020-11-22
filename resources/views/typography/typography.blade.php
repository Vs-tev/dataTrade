<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/trading.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
    <link href="{{ asset('css/portfolio.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/navbar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/rightbar.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('material-icons/iconfont/material-icons.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    {{-- EasySelect --}}
    <link rel="stylesheet" href="easySelect/easySelectStyle.css">
    <script src="easySelect/easySelect.js"></script>
    <title>Document</title>
</head>

<body>

    <div class="container  m-auto">
        <h1>head 1</h1>
        <h2>head 2</h2>
        <h3>head 3</h3>
        <h4>head 4</h4>
        <h5>head 5</h5>
        <h6>head 6</h6>
        <div class="row">
            <div class="col-6">
                <h1>Inputs</h1><br>
                <ul class="list-unstyled">
                    <li>
                        <div class="form-group">
                            <label for="text">Text</label>
                            <input type="text" class="form-control form-control" name="text"
                                placeholder="Here type text">
                        </div>
                    </li>
                    <li class="mt-4 pt-2 border-top">
                        <div class="form-group">
                            <label for="text">Text Danger</label>
                            <input type="text" class="form-control input-error" name="text"
                                placeholder="Here type text">
                            <p class="error-output">This is not allowed</p>
                        </div>
                    </li>
                    <li class="mt-4 pt-2 border-top">
                        <div class="form-group">
                            <label for="text">Text Search</label>
                            <input type="text" class="form-control search-input" name="text"
                                placeholder="Here type text">
                            <span class="material-icons search-i">search</span>
                        </div>
                    </li>
                    <li class="mt-4 pt-2 border-top">
                        <div class="form-group">
                            <label for="text">Info tooltip <span class="material-icons" class="tooltip"
                                    data-toggle="tooltip" data-placement="top"
                                    title="kaslk aclkasclkas clkas nclkan sclk anslck aslcnaslc knalskcnalskc!">info</span>
                            </label>
                            <input type="text" class="form-control" name="text" placeholder="Here type text">
                        </div>
                    </li>
                    <li class="mt-4 pt-2 border-top">
                        <div class="form-group">
                            <label for="text">Text Search <span class="material-icons" class="tooltip"
                                    data-toggle="tooltip" data-placement="top"
                                    title="kaslk aclkasclkas clkas nclkan sclk anslck aslcnaslc knalskcnalskc!">info</span>
                            </label>
                            <input type="text" class="form-control search-input" name="text"
                                placeholder="Here type text">
                            <span class="material-icons search-i">search</span>
                        </div>
                    </li>
                    <li class="mt-4 pt-2 border-top">
                        <div class="form-group">
                            <select id="demo" data-max="2" multiple="multiple">
                                <option value="Volvo">Volvo</option>
                                <option value="Opel">Opel</option>
                                <option value="Audi">Audi</option>
                                <option value="Dodge">Dodge</option>
                                <option value="Toyota">Toyota</option>
                                <option value="Mercedes">Mercedes</option>
                                <option value="Tesla">Tesla</option>
                            </select>

                        </div>
                    </li>
                    <li class="mt-4 pt-2 border-top">
                        <div class="form-group">
                            <label for="textarea">Comment</label>
                            <textarea name="textarea" class="form-control" id="" cols="30" rows="3"></textarea>

                        </div>
                    </li>
                    <li class="mt-4 pt-2 border-top">
                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="customCheck" name="example1">
                            <label class="custom-control-label" for="customCheck">Check this custom checkbox</label>
                        </div>
                    </li>

                </ul>
            </div>

            <div class="col-6 px-4">
                <h1 class="">Buttons</h1>
                <ul class="list-unstyled ">
                    <li class="mt-4">
                        <button class="btn btn-primary">Primary</button>
                    </li>
                    <li class="mt-4">
                        <button class="btn btn-secondary">Secondary</button>
                    </li>
                    <li class="mt-4">
                        <button class="btn btn-link">Btn-link</button>
                    </li>
                    <li class="mt-4">
                        <button class="btn btn-secondary"><span class="material-icons">edit</span></button>
                    </li>


                </ul>
            </div>
        </div>
        <div>
            <table class="table table-sm table-hover">
                <thead class="">
                    <tr>
                        <th>Firstname <span class="unicode-arrow">&#8645;</span></th>
                        <th>Lastname <span class="unicode-arrow">&#8645;</span></th>
                        <th>Email <span class="unicode-arrow">&#8645;</span></th>
                        <th>Firstname <span class="unicode-arrow">&#8645;</span></th>
                        <th>Lastname <span class="unicode-arrow">&#8645;</span></th>
                        <th>Email <span class="unicode-arrow">&#8645;</span></th>
                        <th>Firstname <span class="unicode-arrow">&#8645;</span></th>
                        <th>Lastname <span class="unicode-arrow">&#8645;</span></th>
                        <th>Actions <span class="unicode-arrow">&#8645;</span></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>John</td>
                        <td>Doe</td>
                        <td>john@example.com</td>
                        <td>John</td>
                        <td>Doe</td>
                        <td>john@example.com</td>
                        <td>John</td>
                        <td>Doe</td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-link"><span class="material-icons">settings</span></button>
                                <button class="btn btn-secondary"><span class="material-icons">edit</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-link"><span class="material-icons">settings</span></button>
                                <button class="btn btn-secondary"><span class="material-icons">edit</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-link"><span class="material-icons">settings</span></button>
                                <button class="btn btn-secondary"><span class="material-icons">edit</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-link"><span class="material-icons">settings</span></button>
                                <button class="btn btn-secondary"><span class="material-icons">edit</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-link"><span class="material-icons">settings</span></button>
                                <button class="btn btn-secondary"><span class="material-icons">edit</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-link"><span class="material-icons">settings</span></button>
                                <button class="btn btn-secondary"><span class="material-icons">edit</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-link"><span class="material-icons">settings</span></button>
                                <button class="btn btn-secondary"><span class="material-icons">edit</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-link"><span class="material-icons">settings</span></button>
                                <button class="btn btn-secondary"><span class="material-icons">edit</span></button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>asdascasc
                        </td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>mary@example.com</td>
                        <td>Mary</td>
                        <td>Moe</td>
                        <td>
                            <div class="d-flex">
                                <button class="btn btn-link"><span class="material-icons">settings</span></button>
                                <button class="btn btn-secondary"><span class="material-icons">create</span></button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    $("#demo").easySelect({
        buttons: true,
        search: true,
        placeholder: 'Choose Country',
        placeholderColor: '#6c757d',
        selectColor: '#495057',
        itemTitle: 'Countrys selected',
        showEachItem: true,
        width: '100%',
        dropdownMaxHeight: '450px',
    })

</script>
