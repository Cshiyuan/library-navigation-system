//
//  CSYScanQRViewController.h
//  Library_APP_iOS
//
//  Created by chenshyiuan on 2017/3/8.
//  Copyright © 2017年 chenshyiuan. All rights reserved.
//

#import <UIKit/UIKit.h>



typedef void(^ScanInfoFromQRBlock)(NSString* bookInfo);

@interface CSYScanQRViewController : UIViewController

@property(nonatomic, copy)ScanInfoFromQRBlock scanInfoFromQRBlock;

@end
