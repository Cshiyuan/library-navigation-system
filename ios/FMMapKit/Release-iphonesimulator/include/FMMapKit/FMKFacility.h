//
//  FMKPOI.h
//  FMMapKit
//
//  Created by FengMap on 15/6/24.
//  Copyright (c) 2015年 FengMap. All rights reserved.
//

#import "FMKNode.h"

/**
 *  地图公共设施节点，不支持用户自定义创建
 */
@interface FMKFacility : FMKNode

/**
 *  所在楼层ID
 */
@property (readonly)   NSString*   groupID;
/**
 *  公共设施类型
 */
@property (readonly)   NSString*   type;


/**
 *  透明度
 */
@property (nonatomic, assign)    float   alpha;
/**
 *  选中状态
 */
@property (nonatomic, assign)    BOOL    selected;


@end
