<?php

namespace App\Http\Controllers;

use App\Http\Requests\WalletStoreRequest;
use App\Models\Wallet;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Factory|View
     */
    public function index()
    {
        $wallets = Wallet::all();

        return view("pages.wallet.index", compact('wallets'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('pages.wallet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param WalletStoreRequest $request
     * @return RedirectResponse
     */
    public function store(WalletStoreRequest $request)
    {
//        var_dump($request->validated());
//        exit;
        Wallet::create($request->validated());
        return redirect()->route('wallets.index')->with('message', 'تم إنشاء المحفظة بنجاح');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param Wallet $wallet
     * @return Factory|View
     */
    public function edit(Wallet $wallet)
    {
        return view('pages.wallet.edit', compact('wallet'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param WalletStoreRequest $request
     * @param Wallet $wallet
     * @return RedirectResponse
     */
    public function update(WalletStoreRequest $request, Wallet $wallet)
    {
        $wallet->update($request->validated());

        return redirect()->route('wallets.index')->with('message', 'تم تحديث المحفظة بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Wallet $wallet
     * @return RedirectResponse
     */
    public function destroy(Wallet $wallet)
    {
        $wallet->delete();
        return redirect()->route('wallets.index')->with('message', 'تم حذف المحفظة بنجاح');
    }
}
