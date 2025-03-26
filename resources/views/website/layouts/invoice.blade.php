<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{$order->first_name}} | Invoice</title>
         <style>
            body {
                margin: 0 !important;
                padding: 0 !important;
                -webkit-text-size-adjust: 100% !important;
                -ms-text-size-adjust: 100% !important;
                -webkit-font-smoothing: antialiased !important;
                font-family: sans-serif;
                width: 100%;
                width: 100vw;
                letter-spacing: 0px;
            }

            * {
                box-sizing: border-box;
                -moz-box-sizing: border-box;
                font-family: sans-serif;
            }

            header,
            footer {
                position: fixed;
                left: 0px;
                right: 0px;
            }

            header {
                top: 0px;
                padding-left: 50px;
                padding-right: 50px;
                height: 75px;
                margin-top: -100px;
                border-bottom: 3px solid #1A9120;
            }

            footer {
                bottom: 0px;
                padding-left: 50px;
                padding-right: 50px;
                height: 75px;
                margin-bottom: -100px;
                border-top: 3px solid #1A9120;
            }

            table {
                width: 100%;
            }
            td, th, th-table {
                font-size: 12px;
                line-height: 18px;
            }
            .th-tables, .td-tables {
                font-size: 11px;
            }
            .fw-bold {
                font-weight:bold;
            }
            td p {
                margin:0px;
                font-size: 13px; 
                padding:0px;
            }

            main p {
                margin-bottom: 6px;
                margin-top: 0px;
                line-height:25px;
            }

            .highlighter {
                color: linear-gradient(90deg, #4ca5ff, #b573f8);;
            }

            .heading h2 {
                display: flex;
                align-items: center;
                text-align: center;
                margin: 0;
            }

            .name {
                text-transform: capitalize;
            }

            ol {
                list-style-type: lower-alpha;
                margin-left: 10px;
            }

            ol li {
                color: linear-gradient(90deg, #4ca5ff, #b573f8);;
            }

            @page {
                size: A4;
                margin-left: 0px;
                margin-right: 0px;
                margin-top: 100px;
                margin-bottom: 100px;
            }

            main {
                margin-left: 50px;
                margin-right: 50px;
            }
        </style>
    </head>

    <body style="background-image: url('images/avishlogo.svg'); background-position: center left;
    background-size: 30%;  background-repeat:  no-repeat;">
        <header>
            <img src="{{ public_path('web-assets/assets/images/logo.png') }}" width="150px" style="margin-top:20px">
        </header>
        <footer>
            <table>
            <tbody>
            <tr>
                <td colspan="10">
                    <table style="border-collapse: collapse;" cellspacing="0">
                        </tbody>
                            <tr>
                                <td colspan="5" style="padding:5px 100px 5px 0px;width:50%;">
                                    <p>TealAgro <br></p>
                                    <p>Kasturi Nagar, Bengaluru, Karnataka - 560043</p>
                                </td>
                                <td colspan="5" valign="top">
                                    <p>Phone: +91 6369851854</p> 
                                    <p>Mail: contact@tealagro.com</p> 
                                    <p>Web: tealagro.com</p>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
            </table>
            </footer>

        <main>
            <div class="heading">
                <h2>Invoice</h2>
            </div>
            <p>Hi <span class="highlighter name">{{$order->first_name." ".$order->last_name}}</span>,
            <table>
                <tbody>
                <tr>
                    <td colspan="10">
                        <table style="border-collapse: collapse;" cellspacing="0">
                            </tbody>
                                <tr>
                                    <td colspan="5" style="padding:5px 100px 5px 0px;width:50%;">
                                        <p><b>Invoice No:</b>{{"TA".$order->order_no}}<br></p>
                                        <p><b>Invoice Date:</b>{{Carbon\Carbon::parse($order->created_at)->format("d M Y")}}</p>
                                    </td>
                                    <td colspan="7" style="padding:5px 0px;width:50%;" valign="top">
                                        <p><b>Invoiced To:</b> {{$order->first_name." ".$order->last_name}}</p> 
                                        <p><b>Phone:</b> {{$order->phone_number}}</p> 
                                        <p><b>Email:</b> {{$order->email ?? "-"}}</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </td>
                </tr>
                </tbody>
                </table>
           
                <hr style="border-bottom:1px solid #e5e7eb;border-style:dashed !important;opacity:0.3">
                <div class="heading">
                    <h2>Invoice Details</h2>
                </div>
                <table class="1" border="1" cellspacing="0" cellpadding="0" width="669" style="
                margin-left: -5.4pt;
                border-collapse: collapse;
                border: none;
                margin-top:25px;
            ">
                    <thead>
                        <tr>
                            <th style="text-align:center;height:40px;">S.No</th>
                            <th style="text-align:center;height:40px;">Product</th>
                            <th style="text-align:center;height:40px;">Qty</th>
                            <th style="text-align:center;height:40px;">Price</th>
                            <th style="text-align:center;height:40px;">Sub Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderDetails as $key => $list)
                            <tr>
                                <td style="text-align:center;height:40px;">{{$key+1}}</td>
                                <td style="text-align:center;height:40px;">{{$list->name}}</td>
                                <td style="text-align:center;height:40px;">{{$list->quantity}}</td>
                                <td style="text-align:center;height:40px;">{{$list->price}}</td>
                                <td style="text-align:center;height:40px;">{{$list->sub_total}}</td>
                            </tr>
                        @endforeach
                        <tr>
                            <td style="text-align:center;height:40px;" colspan="3"></td>
                            <td style="text-align:center;height:40px;">SubTotal</td>
                            <td style="text-align:center;height:40px;">{{$order->total_amount}}</td>
                        </tr>
                        <tr>
                            <td style="text-align:center;height:40px;" colspan="3"></td>
                            <td style="text-align:center;height:40px;">Total</td>
                            <td style="text-align:center;height:40px;">{{$order->total_amount}}</td>
                        </tr>
                    </tbody>
                </table>
                <div>
                    <p>
                        <h3 style="line-height:0px;font-size:18px;text-align:center;padding:25px">Authority Signature</h3>
                        <p style="font-size:12px;line-height:5px;text-align:center">This is a computer-generated quotation, hence, no signature is needed.</p>
                    </p>
                </div>
                <div style="text-align:center;vertical-align:bottom;">
                    <p>
                        <h3>THANK YOU FOR YOUR BUSINESS !!</h3>
                    </p>
                </div>
        </main>
</body>

</html>