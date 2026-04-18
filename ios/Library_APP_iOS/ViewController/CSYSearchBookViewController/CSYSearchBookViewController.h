//
//  CSYSearchBookViewController.h
//  Library_APP_iOS
//
//  Created by chenshyiuan on 2017/3/8.
//  Copyright © 2017年 chenshyiuan. All rights reserved.
//

#import <UIKit/UIKit.h>
#import "CSYCommonViewController.h"

@class BookInfo;

typedef void(^clickBookInfoBlock)(BookInfo* bookInfo);

@interface CSYSearchBookViewController : CSYCommonViewController

@property(nonatomic, strong)clickBookInfoBlock bookInfoBlock;
@property(nonatomic, copy)NSString *keyWorkForSearch;

@end
