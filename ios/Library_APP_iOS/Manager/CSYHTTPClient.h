//
//  CSYHTTPClient.h
//  Library_APP_iOS
//
//  Created by chenshyiuan on 2017/3/4.
//  Copyright © 2017年 chenshyiuan. All rights reserved.
//

#import <Foundation/Foundation.h>
#import "AFNetworking.h"

#define LOG_DATA(d) NSLog(@"%@", [[NSString alloc] initWithData:(d) encoding:NSUTF8StringEncoding])
#define LOGIN_URL @"LibraryAPI/Public/libraryapi/?service=User.LoginUser"
#define Search_URL @"LibraryAPI/Public/libraryapi/?service=Book.GetBookInfoByBookName"
#define REGISTER_URL @"LibraryAPI/Public/libraryapi/?service=User.RegisterUser"
#define Book_Image_URL @"http://119.29.186.160/LibraryWeb/Uploads/"


typedef void(^HttpResponseTask)(NSURLSessionDataTask *, id);


typedef enum
{
    CSYErrorCodeHttpResponseNetworkError = 0,
    DMErrorCodeHttpResponseJSONError
} CSYHttpResponseError;

static NSString *const CSYHttpResponseErrorDomain = @"com.chenshyiuan.DMHttpErrorDomain";

@interface CSYHTTPClient : NSObject

@property (nonatomic, copy) NSString *baseURLString;

+ (CSYHTTPClient *)defaultClient;

- (BOOL) netWorkReachabilityWithURLString:(NSString *) strUrl;


//API Request Methods
- (void) getPath:(NSString *)path parameters:(id)parameters success:(void (^)(NSURLSessionDataTask *task, id responseObject))success failure:(void (^)(NSURLSessionDataTask *task, NSError *error))failure;

@end
