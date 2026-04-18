//
//  BookInfo.h
//  Library_APP_iOS
//
//  Created by chenshyiuan on 2017/3/9.
//  Copyright © 2017年 chenshyiuan. All rights reserved.
//

#import <Foundation/Foundation.h>

@interface BookInfo : NSObject

@property(nonatomic,strong)NSString *bookName;
@property(nonatomic,strong)NSString *pubName;
@property(nonatomic,strong)NSString *authors;
@property(nonatomic,strong)NSString *cover_url;
@property(nonatomic,strong)NSString *cover_thumb_url;
@property(nonatomic,strong)NSString *category;
@property(nonatomic,strong)NSString *slfName;

@property(nonatomic,assign)BOOL isOnSlf;

//+(instancetype)init

@end
