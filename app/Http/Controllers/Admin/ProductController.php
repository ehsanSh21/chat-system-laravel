<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\DiscountCode;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Pagination\LengthAwarePaginator;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $sdf=Product::find(43);
//        $sf=$sdf->whereHas('orderItems',function ($q){
//            $q->where('isComplited',false);
//            $q->whereHas('order',function ($q){
//                $q->where('user_id',auth()->user()->id);
//            });
//        })->get();

//        dd($sdf->isOrderd());

        $basket=OrderItem::where('isComplited',false)
            ->whereHas('order',function ($q){
                $q->where('user_id',auth()->user()->id);
            })
            ->get();

        $items = Product::with(['images','comments'])->
        orderBy('id','desc')->get();

        return view('admin.product.index',compact('items','basket'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.product.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }

    public function buy(Product $product)
    {

        $notComplited=OrderItem::where('isComplited',false)
            ->whereHas('order',function ($q){
            $q->whereHas('user',function ($q){
                $q->where('id',auth()->user()->id);
            });
        })->first();

//        if ($notComplited){
//            dd('sdfsdf');
//        }else{
//            dd('true');
//        }

        DB::beginTransaction();

        try {

            if ($notComplited){
               OrderItem::create([
                   'price' => 0,
                   'product_id' => $product->id,
                   'order_id' =>$notComplited->order_id,
                   'qty' => 0,
                   'isComplited'=>false,
               ]);


            }else{
//                dd('sdfsdf');
                $newOrder=Order::create([
                    'user_id' => auth()->user()->id,
                ]);

                $newOrder->items()->create([
                    'price' => 0,
                    'product_id' => $product->id,
                    'qty' => 0,
                    'isComplited'=>false,
                ]);
            }


            DB::commit();
//            dd('asdasd');
        } catch (\Exception $e) {
            DB::rollback();
            // something went wrong
        }

        return redirect()->back();

    }

    public function comOrder(Order $basket)
    {
        $basket->load(['items'=>function($q){
            $q->orderBy('product_id','desc');
        }]);
        return view('admin.product.complete',compact('basket'));
    }


    public function kharid(Request $request,Order $basket)
    {
//        $code="KLKLK";
//
//        $sf=OrderItem::whereHas('product',function ($q) use ($code){
//            $q->whereHas('category',function ($q) use ($code){
//                $q->whereHas('discountCodes',function ($q) use ($code){
//                    $q->where('CODE',$code);
//                });
//            });
//        })->get();



//        dd($sf);

//        dd($request->all());
            foreach ($basket->items as $order){

                if($request->all()[$order->product_id."code"]==null){
                    $order->update([
                        'qty' =>$request->all()[$order->product_id],
                        'price' => $order->product->price*$request->all()[$order->product_id],
                        'isComplited' => 1,
                    ]);
                }
                else{
                    $dis=DiscountCode::whereHas('category',function ($q) use($order){
                        $q->whereHas('product',function ($q) use ($order){
                            $q->where('id',$order->product_id);
                        });
                    })->first();

//                    dd($dis->code);


                    if ($dis && $dis->code==$request->all()[$order->product_id."code"]){
//                        dd((($dis->discount_percent)/100));
                        $order->update([
                            'qty' =>$request->all()[$order->product_id],
                            'price' => $order->product->price*$request->all()[$order->product_id]
                                *(1-(($dis->discount_percent)/100)),
                            'useDiscount'=>1,
                            'isComplited' => 1,
                        ]);

                    }else{
                        $order->update([
                            'qty' =>$request->all()[$order->product_id],
                            'price' => $order->product->price*$request->all()[$order->product_id],
                            'isComplited' => 1,
                        ]);

                    }
                }
            }



            return redirect(route('admin.products.final',$basket));



    }

    public function cancel(Product $product)
    {

        OrderItem::where('product_id',$product->id)
            ->where('isComplited',false)
            ->whereHas('order.user',function ($q){
                $q->where('id',auth()->user()->id);
            })->delete();
        return redirect()->back();
    }

    public function generate()
    {
        dd('sdfs');
    }

    public function final(Order $basket)
    {
        return view('admin.product.final',compact('basket'));
    }

    public function orders()
    {

        $orders= Order::whereHas('user',function ($q){
            $q->where('id',auth()->user()->id);
        })->has('items')
            ->orderBy('id','desc')
            ->paginate(8);
//        dd($orders[0]->profit());
        return view('admin.product.orders',compact('orders'));

    }

    public function orderItems(Order $order)
    {
        $basket=$order;

        return view('admin.product.final',compact('basket'));
    }

    public function orderByQty()
    {


        $orders= Order::query()
            ->where('user_id',auth()->user()->id)
            ->join('order_items','orders.id','=','order_items.order_id')
            ->groupBy('orders.id')
            ->select('orders.id','orders.user_id',
                'order_items.order_id',
                DB::raw('COUNT(order_items.product_id) as total_products')
                ,
                DB::raw('SUM(order_items.qty) as total_quantity')
            )
            ->orderBy('total_quantity','desc')
            ->paginate(8)
            ;

        return view('admin.product.orders',compact('orders'));
        return redirect()->back();

    }

    public function orderByItems()
    {

        $orders=Order::whereHas('user',function ($q){
            $q->where('id',auth()->user()->id);
        })->withCount('items')
            ->has('items')
            ->orderBy('items_count','desc')
            ->paginate(8);


        return view('admin.product.orders',compact('orders'));
        return redirect()->back();
    }

    public function orderByMostProfit()
    {

        $orders= Order::whereHas('user',function ($q){
            $q->where('id',auth()->user()->id);
        })->has('items')
            ->get();

//        dd($orders);
        $orders= $orders->transform(function ($order) {
            $order->profit =$order->profit;
            return $order;
        })
        ->sortByDesc('profit')

//            ->pluck('id','profit')
        ;


// Paginate the sorted orders
        $perPage = 8; // Number of items per page
        $currentPage = Paginator::resolveCurrentPage(); // Get the current page number
        $offset = ($currentPage - 1) * $perPage;
        $slicedOrders = $orders->slice($offset, $perPage);
        $orders = new LengthAwarePaginator(
            $slicedOrders,
            $orders->count(),
            $perPage,
            $currentPage,
            [
                'path' => route('admin.products.orderByMostProfit'), // The path for the current page
            ]
        );

//        dd($orders);

        View::share('admin.product.orders', $orders);
        return view('admin.product.orders',compact('orders'));

//        return redirect()->back();

    }

    public function bestSellingProducts()
    {
        $products= Product::query()
            ->join('order_items', 'products.id', '=', 'order_items.product_id')
            ->select('products.*', DB::raw('SUM(order_items.qty) as total_quantity'))
            ->groupBy('order_items.product_id')
            ->orderBy('total_quantity','desc')
            ->paginate(8);



//        dd($products);

        return view('admin.product.best-selling-products',compact('products'));
    }


}
