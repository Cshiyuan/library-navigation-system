//
//  CSYToolSet.m
//  Library_APP_iOS
//
//  Created by chenshyiuan on 2017/3/9.
//  Copyright © 2017年 chenshyiuan. All rights reserved.
//

#import "CSYToolSet.h"
#define Book_Image_URL @"http://119.29.186.160/LibraryWeb/Uploads/"

@implementation CSYToolSet


+(BookInfo *)getBookInfoWithDictionary:(NSDictionary *)dictionary
{
    BookInfo *info = [[BookInfo alloc]init];
    info.bookName = dictionary[@"book_name"];
    info.slfName = dictionary[@"slf_name"];
//    info.cover_url = dictionary[@"cover"];
    info.cover_url = [NSString stringWithFormat:@"%@%@",Book_Image_URL,dictionary[@"cover"]];
    info.cover_thumb_url = [NSString stringWithFormat:@"%@%@",Book_Image_URL,dictionary[@"cover_thumb"]];
    info.authors = dictionary[@"author"];
    info.category = dictionary[@"category"];
    info.isOnSlf = dictionary[@"is_onslf"];
    info.pubName = dictionary[@"pub_house"];
    return info;
}


+ (UIImage *)viewSnapshot:(UIView *)view withInRect:(CGRect)rect;
{
    UIGraphicsBeginImageContext(view.bounds.size);
    [view.layer renderInContext:UIGraphicsGetCurrentContext()];
    UIImage *image = UIGraphicsGetImageFromCurrentImageContext();
    UIGraphicsEndImageContext();
    image = [UIImage imageWithCGImage:CGImageCreateWithImageInRect(image.CGImage,rect)];
    return image;
}

@end
