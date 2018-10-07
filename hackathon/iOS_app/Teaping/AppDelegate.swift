//
//  AppDelegate.swift
//  Teaping
//
//  Created by Małgorzata Dziubich on 06/10/2018.
//  Copyright © 2018 GGC. All rights reserved.
//

import UIKit

@UIApplicationMain
class AppDelegate: UIResponder, UIApplicationDelegate {

    var window: UIWindow?

    func application(_ application: UIApplication, didFinishLaunchingWithOptions launchOptions: [UIApplicationLaunchOptionsKey: Any]?) -> Bool {

        //Stripe configuration
        Stripe.setDefaultPublishableKey(Global.stripePublishableKey)

        return true
    }
}

