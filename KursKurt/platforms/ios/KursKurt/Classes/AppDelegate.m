/*
 Licensed to the Apache Software Foundation (ASF) under one
 or more contributor license agreements.  See the NOTICE file
 distributed with this work for additional information
 regarding copyright ownership.  The ASF licenses this file
 to you under the Apache License, Version 2.0 (the
 "License"); you may not use this file except in compliance
 with the License.  You may obtain a copy of the License at

 http://www.apache.org/licenses/LICENSE-2.0

 Unless required by applicable law or agreed to in writing,
 software distributed under the License is distributed on an
 "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 KIND, either express or implied.  See the License for the
 specific language governing permissions and limitations
 under the License.
 */

//
//  AppDelegate.m
//  KursKurt
//
//  Created by ___FULLUSERNAME___ on ___DATE___.
//  Copyright ___ORGANIZATIONNAME___ ___YEAR___. All rights reserved.
//

#import "AppDelegate.h"
#import "MainViewController.h"
#import "UserNotifications/UserNotifications.h"
#import "OneSignal/OneSignal.h"
#import "UIKit/UIKit.h"


@implementation AppDelegate

- (BOOL)application:(UIApplication*)application didFinishLaunchingWithOptions:(NSDictionary*)launchOptions
{
    self.viewController = [[MainViewController alloc] init];
    //Create category for notification with action buttons
    UNUserNotificationCenter *center = [UNUserNotificationCenter currentNotificationCenter];
    center.delegate = self;
    
    UNMutableNotificationContent *content = [UNMutableNotificationContent new];

    
    UNNotificationAction *goodAction = [UNNotificationAction actionWithIdentifier:@"Good"
                                                                              title:@"Bra!" options:UNNotificationActionOptionNone];
    UNNotificationAction *badAction = [UNNotificationAction actionWithIdentifier:@"Bad"
                                                                              title:@"Dålig!" options: UNNotificationActionOptionNone];
    UNNotificationCategory *category = [UNNotificationCategory categoryWithIdentifier:@"KurtLecture"
                                                                              actions:@[goodAction,badAction] intentIdentifiers:@[]
                                                                              options:UNNotificationCategoryOptionNone];
    NSSet *categories = [NSSet setWithObject:category];
    [center setNotificationCategories:categories];
    content.categoryIdentifier = @"KurtLecture";
    
    NSLog((@"didFinishLaunchingWithOptions"));

    
    return [super application:application didFinishLaunchingWithOptions:launchOptions];

}


//Fungerar inte, ska låta appen sköta svar i bakgrunden
- (void)userNotificationCenter:(UNUserNotificationCenter *)center didReceiveNotificationResponse:(UNNotificationResponse *)response withCompletionHandler:(void(^)())completionHandler{
    //Run JavaScript
    NSString *jsCallBack = @"submitForm()";
    NSLog(@"jsCallBack: %@", jsCallBack);
    
    //Called to let your app know which action was selected by the user for a given notification.
    NSLog((@"didReceiveNotifiacitonResponse"));
    NSLog(@"Userinfo %@",response.notification.request.content.userInfo);
    
}

- (void)webViewDidFinishLoad:(UIWebView *)webView {
    if ([[webView stringByEvaluatingJavaScriptFromString:@"document.readyState"] isEqualToString:@"complete"]) {
        // UIWebView object has fully loaded.
        NSLog(@"webViewFinishedLoad");
    }
}

@end
