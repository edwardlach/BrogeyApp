//
//  ModelController.h
//  Brogey Golf
//
//  Created by Edward D Lach on 5/13/14.
//  Copyright (c) 2014 Brogey Golf. All rights reserved.
//

#import <UIKit/UIKit.h>

@class DataViewController;

@interface ModelController : NSObject <UIPageViewControllerDataSource>

- (DataViewController *)viewControllerAtIndex:(NSUInteger)index storyboard:(UIStoryboard *)storyboard;
- (NSUInteger)indexOfViewController:(DataViewController *)viewController;

@end
